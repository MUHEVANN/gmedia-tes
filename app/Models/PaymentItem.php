<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    protected $fillable = [
        "payment_id",
        "product_id",
        "quantity",
    ];
}
