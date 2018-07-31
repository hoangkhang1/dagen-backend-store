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
    protected $primaryKey = 'store_login_id';
    protected $keyType = 'varchar';
    protected $fillable = [
        'store_id',
        'store_login_username',
        'store_login_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'store_login';
    protected $hidden = [
         'remember_token',
    ];
}
