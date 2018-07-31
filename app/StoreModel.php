<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreModel extends Model
{
    protected $table = 'store';
    protected $keyType = 'varchar';
    protected $primaryKey = 'store_id';
    protected $fillable = [
        'store_id',
        'store_username',
        'userid',
        'title',
        'key',
        'description',
        'store_address',
        'store_phone',
        'store_email',
        'store_image',
        'status',
        'rating',
        'transaction',
    ];
}
