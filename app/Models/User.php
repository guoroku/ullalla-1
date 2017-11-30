<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $dates = ['package1_expiry_date', 'package2_expiry_date'];

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

    public function spoken_languages()
    {
        return $this->belongsToMany('App\Models\SpokenLanguage', 'user_spoken_language')->withPivot('language_level');
    }

    public function canton()
    {
        return $this->belongsTo('App\Models\Canton');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function contact_options()
    {
        return $this->belongsToMany('App\Models\ContactOption', 'user_contact_option');
    }

    public function service_options()
    {
        return $this->belongsToMany('App\Models\ServiceOption', 'user_service_options');
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('role_name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    public function assignRoles($roles)
    {
        if (is_array($roles)) {
            $rolesToBeAssign = Role::whereIn('role_name', $roles)->get()->toArray();
            $roleIds = [];
            $roleIds = array_column($rolesToBeAssign, 'id');
            $this->roles()->sync($roleIds);
        } else {
            $roleToBeAsign = Role::where('role_name', $roles)->first();
            $this->roles()->attach($roleToBeAsign);
        }
    }

    public function isAdmin()
    {
        return $this->hasRole('admin') ? true : false;
    }

    public static function scopeApproved($query)
    {
        $query->where('approved', '1');
    }

    public static function scopePayed($query)
    {
        $query->where('is_active_d_package', '1');
    }

    public static function scopeNickname($query, $nickname)
    {
        $query->where('nickname', $nickname);
    }

    public function hasContact()
    {
        return ($this->address || $this->phone || $this->city || $this->mobile) ? true : false;
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function getPackageExpireAttribute($date)
    {
        return Carbon::parse($date);
    }

}
