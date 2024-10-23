<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{

    public function totalAmount($cart)
    {
        $totalAmount = 0;

        foreach ($cart->product as $product) {
            $totalAmount += $product->price * $product->pivot->quantity;
        }
        return $totalAmount;
    }
    public function loadTable()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cart->load('product');
        return $cart;
    }
}