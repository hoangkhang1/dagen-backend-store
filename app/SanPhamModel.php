<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPhamModel extends Model
{
    protected $table = 'products';
    protected $keyType = 'varchar';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'userid',
        'storeid',
        'sku',
        'catid',
        'name',
        'description',
        'price',
        'price_reference',
        'image_front',
        'image_gallery',
        'hashtag',
        'product_option',
        'status',
        'liked',
        'comment',
        'transaction',
    ];
}
