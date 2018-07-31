<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $primaryKey = 'product_id';
    protected $table = 'products';
    protected $fillable = ['product_id',
        'storeid',
        'userid',
        'sku',
        'name',
        'description',
        'price', 'price_reference',
        'image_front', 'image_gallery',
        'hashtag', 'product_option', 'liked',
        'comment', 'transaction', 'created_at', 'updated_at'];

}
