<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyStoreModel extends Model
{
    protected $table = 'key_store';
    protected $primaryKey = 'key';
    protected $keyType = 'int';
    protected $fillable = [
        'key', 'id_store', 'password', 'is_active'
    ];
    public $incrementing = false;
}
