<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{



    public function store()
    {
        $validate = Validator::make(request()->all(), [
            "category_id" => "required",
            "product_id" => "required"
        ]);

        if ($validate->fails()) {
            return response()->json(["error" => $validate->messages()], 400);
        }

        $cart = Cart::firstOrCreate([
            "user_id" => Auth::id(),
        ]);
        $cartProduct = $cart->product()->where('product_id', request('product_id'))->first();
        if ($cartProduct) {
            $newQuantity = $cartProduct->pivot->quantity + 1;
            $cart->product()->updateExistingPivot(request('product_id'), [
                'quantity' => $newQuantity
            ]);
        } else {
            $cart->product()->attach(request('product_id'), [
                'quantity' => request('quantity') ?? 1
            ]);
        }

        $carts = Cart::where('user_id', Auth::id())->first();
        $sum = 0;
        if ($carts) {
            $cartProducts = CartProduct::where('cart_id', $carts->id)->get();
            $sum  += $cartProducts->sum('quantity');
        }

        if ($cart) {
            return response()->json([
                "message" => "Product added to cart successfully",
                'sum' => view('components.quantity', compact('sum'))->render()
            ], 200);
        }
        return response()->json(["error" => "Failed to add product to cart"], 500);
    }

    public function index()
    {
        $cart = $this->loadTable();

        $totalAmount = $this->totalAmount($cart);
        return view('dashboard.cart.index', compact('cart', 'totalAmount'));
    }

    public function destroy($id)
    {

        $cart = Cart::where('user_id', Auth::id())->first();
        CartProduct::where('product_id', $id)->where('cart_id', $cart->id)->delete();
        $cart->load('product');
        $totalAmount = $this->totalAmount($cart);
        return response()->json([
            "message" => "Product removed from cart successfully",
            'cart' => view('components.table-product', compact('cart'))->render(),
            'total' => view('components.total', compact('totalAmount'))->render()
        ], 200);
    }
    public function jumlah($action, $product)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartProduct = $cart->product()->where('product_id', $product->id)->first();
        if ($action === 'tambah') {
            $newQuantity = $cartProduct->pivot->quantity + 1;
        } else {
            if ($cartProduct->pivot->quantity > 1) {
                $newQuantity = $cartProduct->pivot->quantity - 1;
            } else {
                CartProduct::where('product_id', $product->id)->where('cart_id', $cart->id)->delete();
                $cart->load('product'); // Perbarui cart untuk memastikan tidak ada produk
                return $cart;
            }
        }
        $cart->product()->updateExistingPivot($product->id, [
            'quantity' => $newQuantity
        ]);

        return $cart->load('product');
    }

    public function cart_tambah(Product $product)
    {
        $cart = $this->jumlah('tambah', $product);

        $sum = $cart->product->where('id', $product->id)->sum(function ($product) {
            return $product->pivot->quantity;
        });

        $totalAmount = $this->totalAmount($cart);

        $newCart = $this->loadTable();
        return response()->json([
            'success' => "Product removed",
            'sum' => view('components.quantity-single', compact('sum'))->render(),
            'cart' => view('components.table-product', compact('cart'))->render(),
            'total' => view('components.total', compact('totalAmount'))->render()
        ], 200);
    }

    public function cart_kurang(Product $product)
    {
        $cart = $this->jumlah('kurang', $product);

        $sum = $cart->product->where('id', $product->id)->sum(function ($product) {
            return $product->pivot->quantity;
        });

        $totalAmount = $this->totalAmount($cart);
        $newCart = $this->loadTable();

        return response()->json([
            'success' => "Product removed",
            'sum' => view('components.quantity-single', compact('sum'))->render(),
            'cart' => view('components.table-product', compact('cart'))->render(),
            'total' => view('components.total', compact('totalAmount'))->render()
        ], 200);
    }
}
