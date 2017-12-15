<?php

namespace App\Traits;

use App\Friendship;
use Illuminate\Support\Facades\App;

trait Friendable
{

    function add_friend($user_requested_id)
    {

        if ($this->id == $user_requested_id)
        {
            return 0;
        }


        if ($this->has_pending_friend_request_to($user_requested_id) === 1)
        {
            return "Request Already Sent";
        }


        if ($this->has_pending_friend_request_from($user_requested_id) === 1)
        {
            return $this->accept_friend($user_requested_id);
        }



        $friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id,

        ]);

        if ($friendship)
        {
            return response()->json($friendship, 200);
        }

        return response()->json('fail', 501);

    }











    function accept_friend($requester)
    {

        if ($this->has_pending_friend_request_from($requester) === 0)
        {
            return 0;
        }


        $friendship = Friendship::where('requester', $requester)
                            ->where('user_requested', $this->id)
                            ->first();

        if ($friendship)
        {
            $friendship->update(['status' => 1]);

            return response()->json($friendship, 200);
        }

        return response()->json('fail', 501);

    }













    function friends()
    {
        $friends1 = array();

        $f1 = Friendship::where('status', 1)
                        ->where('requester', $this->id)
                        ->get();

        foreach ($f1 as $friendship)
        {
            array_push($friends1, \App\User::find($friendship->user_requested));

        }




        $friends2 = array();

        $f2 = Friendship::where('status', 1)
                        ->where('user_requested', $this->id)
                        ->get();


        foreach ($f2 as $friendship)
        {
            array_push($friends2, \App\User::find($friendship->requester));
        }

        return array_merge($friends1, $friends2);
    }




    function friends_ids()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }















    function pending_friend_requests()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)
                                ->where('user_requested', $this->id)
                                ->get();


        foreach ($friendships as $friendship)
        {
            array_push($users, \App\User::find($friendship->requester));
        }

        return $users;


    }



    function pending_friend_requests_ids()
    {
        return collect($this->pending_friend_requests())->pluck('id')->toArray();
    }













    function pending_friend_requests_sent()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)
            ->where('requester', $this->id)
            ->get();


        foreach ($friendships as $friendship)
        {
            array_push($users, \App\User::find($friendship->user_requested));
        }

        return $users;


    }



    function pending_friend_requests_sent_ids()
    {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }










    function is_friends_with($user_id)
    {
        if (in_array($user_id, $this->friends_ids()))
        {
            return 1;
        }

        else
        {
            return response()->json('false', 200);
        }
    }










    function has_pending_friend_request_from($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_ids()))
        {
            return 1;
        }

        else
        {
             return 0;
        }
    }




    function has_pending_friend_request_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_sent_ids()))
        {
            return 1;
        }

        else
        {
            return 0;
        }

    }

}
