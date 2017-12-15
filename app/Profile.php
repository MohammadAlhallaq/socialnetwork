<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['location', 'about', 'user_id'];


    function user()
    {
        return $this->belongsTo(User::class);
    }
}

