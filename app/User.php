<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //for HasMany relation
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function city(){
        return $this->hasOne('App\City');
    }
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function comments(){
        return $this->morphMany('App\Comment','commendable');
    }
}
