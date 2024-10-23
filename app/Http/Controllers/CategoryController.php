<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create()
    {
        return view('dashboard.category.create');
    }


    public function store()
    {
        $validated = Validator::make(request()->all(), [
            'name' => 'required'
        ]);

        if ($validated->fails()) {
            if(request()->ajax()){
                return response()->json([
                    'error' => $validated->messages()
                ]);
            }
            return redirect()->back()->withErrors($validated->messages())->withInput();
        }

        $category = Category::create([
            'name' => request('name')

        ]);

        $productCategory = Category::with('product')->get();
        
        if ($category) {
            if (request()->ajax()) {
                return response()->json([
                    "message" => "Category created successfully",
                    'productCategory' => view('components.list-product-mobile', compact('productCategory'))->render(),
                    'category' => view('components.category', compact('productCategory'))->render(),
                ]);
            }
            return redirect()->back()->with('success', 'Category created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create category');
    }

    public function index()
    {
        $category = Category::with('products')->get();
        return response()->json([
            "products" => view('components.card-product', compact('category'))->render()
        ]);
    }
}