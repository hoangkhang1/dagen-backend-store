<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    protected $table = 'users_profile';
    protected $keyType = 'varchar';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'userid',
        'tel',
        'name',
        'email',
        'address',
        'birthday',
        'sex',
        'avatar',
    ];
}
