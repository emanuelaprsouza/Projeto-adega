<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $cart = Auth::user()->cart;

        return view('checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|exists:payments,id',
            'address' => 'required|string|max:255',
        ]);

        $cart = Auth::user()->cart;
        if ($cart->items->isEmpty()) {
            return back()->withErrors('O carrinho está vazio.');
        }

        $payment = Payment::find($request->payment_method);

        $order = Order::create([
            'user_id' => Auth::id(),
            'payment_id' => $payment->id,
            'total' => $cart->total,
            'address' => $request->address,
            'status' => OrderStatusEnum::PENDING,
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Limpar o carrinho após a criação do pedido
        $cart->items()->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Pedido realizado com sucesso!');
    }
}
