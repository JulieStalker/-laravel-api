<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;  //need to add for passport

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;  //HasApiTokens for Passport

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password' //, 'remember_token',
    ];

    /** not using because of password
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = [
      //  'email_verified_at' => 'datetime',
   // ];
}
