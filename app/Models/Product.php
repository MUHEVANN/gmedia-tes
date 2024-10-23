<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "price",
        "image",
        "category_id"
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}