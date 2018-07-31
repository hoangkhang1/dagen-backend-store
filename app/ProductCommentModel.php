<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCommentModel extends Model
{
    protected $table = 'product_comment';
    protected $primaryKey = 'comment_id';
    protected $fillable = ['userid','productid',
        'comment_parent_id','title',
        'comments', 'reply', 'store_reply_message','seen','created_at','updated_at'];
    protected $keyType = 'varchar';
}
