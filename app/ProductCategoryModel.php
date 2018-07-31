<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'product_category';
    protected $keyType = 'varchar';
    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'cat_id',
        'userid',
        'store_id',
        'cat_parent',
        'name',
        'description',
    ];
}
