<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $fillable = ['user_id', 'post_id'];

    public $with = ['user'];



    function post()
    {
        return $this->belongsTo(Post::class);
    }


    function user()
    {
        return $this->belongsTo(User::class);
    }


}
