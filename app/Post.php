<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable  = ['content', 'user_id'];

    public $with = ['user', 'likes'];


    function user()
    {
        return $this->belongsTo(User::class);
    }


    function likes()
    {
        return $this->hasMany(Like::class);
    }


}
