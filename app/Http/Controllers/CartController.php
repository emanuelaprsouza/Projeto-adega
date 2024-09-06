<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('catalog/cart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id(), 'product_id' => $product->id]);

        // Atualizar a quantidade se o produto já estiver no carrinho
        $cart->quantity = ($cart->quantity ?? 0) + ($request->quantity ?? 1);
        $cart->save();

        return response()->json(['message' => 'Produto adicionado ao carrinho']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        $cart = Cart::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
