<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfilesController extends Controller
{
    function index($slug)
    {

        $user = User::where('slug', $slug)->first();
        return view('profile.profile', compact('user'));
    }



    function edit()
    {
        $info = Auth::user()->profile;
        return view('profile.edit', compact('info'));

    }


    function update(Request $request)
    {

        $this->validate($request, [
            'location' => 'required',
            'about'    => 'required|max:255'
        ]);



        if ($request->hasFile('avatar'))
        {

            $avatar = $request->file('avatar')->store('public/avatars');

            Auth::user()->update([
               'avatar' => $avatar
            ]);
        }


        Auth::user()->profile->update([
            'location' => $request->location,
            'about'    => $request->about
        ]);

        Session::flash('success', 'Profile Updated!');

        return redirect()->back();

    }


    function search($query)
    {

       return $orders = User::search($query)->raw();


    }





}
