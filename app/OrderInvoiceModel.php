<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInvoiceModel extends Model
{
    protected $table = 'order_invoice';
    protected $keyType = 'varchar';
    protected $primaryKey = 'invoice_id';
    protected $fillable = [
        'invoice_id',
        'order_code',
        'storeid',
        'userid',
        'name',
        'phone',
        'address',
        'email',
        'note',
        'total',
        'processed_date',
        'processed_user',
        'processed_note',
        'processed_status',
    ];
}
