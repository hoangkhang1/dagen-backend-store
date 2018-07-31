<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $keyType = 'varchar';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'ref',
        'parent',
        'username',
        'phone',
        'password',
        'otp',
        'tokenAccess',
        'role',
    ];
}
