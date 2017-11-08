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
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_activation()
    {
        return $this->hasOne('App\Models\UserActivation');
    }

    public function user_type()
    {
        return $this->belongsTo('App\Models\UserType');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'user_service');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function canton()
    {
        return $this->belongsTo('App\Models\Canton');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }
}
