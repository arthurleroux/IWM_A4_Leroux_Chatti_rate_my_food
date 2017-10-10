<?php

namespace App\Models;

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

    /**
     * Get the restaurants record associated with the user.
     */
    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }

    /**
     * Get the reviews record associated with the user.
     */
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
}
