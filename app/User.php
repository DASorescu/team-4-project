<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetail(){

        return $this->hasOne('App\Models\UserDetail');
    }

    public function specializations(){

        return $this->belongsToMany('App\Models\Specialization');
    }

    public function messages(){

        return $this->hasMany('App\Models\Message');
    }

    public function reviews(){

        return $this->hasMany('App\Models\Review');
    }

    public function sponsorships(){

        return $this->belongsToMany('App\Models\Sponsorship')->withTimestamps()->withPivot('ends_at');
    }

    public function services(){

        return $this->hasMany('App\Models\Service');
    }
}
