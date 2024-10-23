<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $category = Category::first();
        $categories = Category::all();
        $catogory_id = request('category_id') ?? ($category->id ?? "");
        $products = Product::where('category_id', $catogory_id)->get();
        $cart = Cart::where('user_id', Auth::id())->first();
        $sum = 0;
        if ($cart) {
            $cartProduct = CartProduct::where('cart_id', $cart->id)->get();
            $sum  += $cartProduct->sum('quantity');
        }

        $productCategory = Category::with('product')->get();
        if (request()->ajax()) {
            return response()->json([
                'productCategory' => view('components.list-product-mobile', compact('productCategory'))->render(),
                'products' => view('components.card-product', compact('products'))->render(),
            ]);
        }
        return view('dashboard.index', compact('products', 'categories', 'sum', 'productCategory'));
    }
}
