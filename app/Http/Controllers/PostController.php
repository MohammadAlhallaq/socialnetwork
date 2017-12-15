<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function store(Request $request)
    {
        return Post::create([
            "content" => $request['content'],
            "user_id" => Auth::id()
        ]);
    }





    function feed()
    {
        $friends = Auth::user()->friends();

        $feed = array();

        foreach ($friends as $friend)
        {
            foreach ($friend->posts as $post)
            {
                array_push($feed, $post);
            }
        }


        foreach (Auth::user()->posts as $post)
        {
            array_push($feed, $post);
        }

        usort($feed, function ($p1, $p2){

            return $p1->id < $p2->id;

        });


        return $feed;

    }

}
