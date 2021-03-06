<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    function like($id)
    {

        $post = Post::find($id);


         $like = Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

         return Like::find($like->id);
    }



    function unlike($id)
    {
        $post = Post::find($id);

         $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $post->id)
                    ->first();

//         $like->delete();

         return $like->id;
    }
}
