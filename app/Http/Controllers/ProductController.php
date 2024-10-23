<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create()
    {

        $category = Category::all();
        return view('dashboard.product.create', compact('category'));
    }


    public function store()
    {
        $validated = Validator::make(request()->all(), [
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'required|mimes:jpg,jpeg,png,webp,svg',
            'category_id' => 'required',
        ]);

        if ($validated->fails()) {
            if (request()->ajax()) {
                return response()->json([
                    'error' => $validated->messages()
                ]);
            }
            return redirect()->back()->withErrors($validated->messages())->withInput();
        }

        $image_file = request()->file('image');
        $image_name = Str::uuid() . "." . $image_file->getClientOriginalExtension();
        $image_file->storeAs('products', $image_name, 'public');

        $product = Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'image' => $image_name,
            'category_id' => request('category_id'),
        ]);

        $productCategory = Category::with('product')->get();

        $categoryId = request()->category_url ?? Category::first()->id;

        $products = Product::where('category_id', $categoryId)->get();
        if ($product) {
            if (request()->ajax()) {
                return response()->json([
                    'productCategory' => view('components.list-product-mobile', compact('productCategory'))->render(),
                    'products' => view('components.card-product', compact('products'))->render(),
                ]);
            }
            return redirect()->back()->with('success', 'Category created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create category');
    }

    public function search()
    {
        $productCategory = Category::with('product')->whereHas('product', function ($query) {
            return $query->where('name', 'like', '%' . request('search') . '%');
        })->get();
        return response()->json([
            'productCategory' => view('components.list-product-mobile', compact('productCategory'))->render(),
        ]);
    }

    public function destroy(Product $product)
    {

        $product->delete();
        unlink(public_path('storage/products/' . $product->image));

        $categoryId = request()->category_id ?? Category::first()->id;

        $products = Product::where('category_id', $categoryId)->get();
        $cart = Cart::where('user_id', Auth::id())->first();

        $sum = 0;
        if ($cart) {
            $cartProduct = CartProduct::where('cart_id', $cart->id)->get();
            $sum  += $cartProduct->sum('quantity');
        }

        $productCategory = Category::with('product')->get();

        return response()->json([
            'productCategory' => view('components.list-product-mobile', compact('productCategory'))->render(),
            'products' => view('components.card-product', compact('products'))->render(),
            'sum' => view('components.quantity', compact('sum'))->render()
        ]);
    }
}
