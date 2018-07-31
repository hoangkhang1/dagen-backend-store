<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $keyType = 'varchar';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_id',
        'invoiceid',
        'productid',
        'product_option',
        'paid',
        'paid_date',
        'user_process',
        'quantity',
        'price',
        'total'
    ];
}
