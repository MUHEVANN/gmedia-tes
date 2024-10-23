<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Payment;
use App\Models\PaymentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store()
    {
        $cart = $this->loadTable();

        $payment = Payment::firstOrCreate([
            'user_id' => Auth::id(),
            'status' => 'success',
            'total_amount' => 0
        ]);

        $total_amount = 0;
        $cartItem = CartProduct::where('cart_id', $cart->id)->get();
        foreach ($cart->product as $product) {
            $total_amount += $product->price * $product->pivot->quantity;
            $paymentItem = PaymentItem::create([
                'payment_id' => $payment->id,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
            ]);
        }

        $payment->update([
            'total_amount' => $total_amount
        ]);

        $cartItem->each(function ($item) {
            $item->delete();
        });

        $totalAmount = 0;

        $cart = $this->loadTable();
        return response()->json([
            'message' => 'Payment processed successfully.',
            "total_amount" =>  $payment->total_amount,
            'cart' => view('components.table-product', compact('cart'))->render(),
            'total' => view('components.total', compact('totalAmount'))->render()
        ]);
    }
}
