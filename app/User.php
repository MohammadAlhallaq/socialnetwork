<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable, Friendable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'slug', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    function profile()
    {
        return $this->hasOne(Profile::class);
    }

    function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }

}
