<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequestAccepted;
use App\Notifications\NewFriendRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipsController extends Controller
{
    function check($id)
    {
        if (Auth::user()->is_friends_with($id) === 1)
        {
            return ['status' => 'friends'];
        }


        if (Auth::user()->has_pending_friend_request_from($id))
        {
            return ['status' => 'pending'];
        }


        if (Auth::user()->has_pending_friend_request_to($id))
        {
            return ['status' => 'waiting'];
        }

        return ['status' => 0];
    }


    function add_friend($id)
    {

        $resp = Auth::user()->add_friend($id);

        User::find($id)->notify(new NewFriendRequest(Auth::user()));

        return $resp;
    }

 
    function accept_friend($id)
    {
        $resp = Auth::user()->accept_friend($id);

        User::find($id)->notify(new FriendRequestAccepted(Auth::user()));

        return $resp;


    }

}
