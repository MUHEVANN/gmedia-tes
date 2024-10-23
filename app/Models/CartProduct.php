<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'cart_product';
    protected $fillable = ['product_id', 'category_id', 'quantity', 'cart_id'];
}
