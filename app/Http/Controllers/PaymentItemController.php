<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentItemController extends Controller
{
    public function store()
    {
        
        
        // $paymentItem = PaymentItem::create([
        //     'payment_id' => request('payment_id'),
        //     'product_id' => request('product_id'),
        //     'quantity' => request('quantity'),
        //     'price' => request('price')
        // ]);
        
        // $payment = Payment::firstOrCreate([
        //     'user_id' => Auth::id(),
        //     'status' => 'success',
        //     'total_amount' => 0
        // ]);
    }
}