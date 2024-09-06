<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        $cart = Cart::all();

        foreach ($products as $product) {
            $product->image_url = $product->getFirstMediaUrl('images');
        }

        return view('catalog.products', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'ILIKE', "%{$query}%")
            ->get();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->image_url = $product->getFirstMediaUrl('images');

        return view('catalog.product-details', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
