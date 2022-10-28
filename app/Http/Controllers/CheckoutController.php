<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('checkout', [
            'carts' => $carts,
        ]);
    }
    function order(Request $request)
    {
        $shipping = null;
        if ($request->shipping == 0) {
            $shipping = 130;
        } else {
            $shipping = 70;
        }

        $carts = Cart::where('user_id', Auth::id())->get();
        $subtotal = 0;
        if (cart::where('user_id', Auth::id())->count() > 0) {
            foreach ($carts as $cart) {
                $subtotal += $cart->rel_to_product->discount_price * $cart->quantity;
            }
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'phone' => $request->phone,
                'address' => $request->address,
                'message' => $request->message,
                // 'discount' => $request->discount,
                'delivery_charge' => $shipping,
                'total' => $subtotal + $shipping,
                // 'payment_method' => $request->payment_method,
                'created_at' => Carbon::now(),
            ]);

            foreach ($carts as $cart) {
                ProductOrder::insert([
                    'user_id' => Auth::id(),
                    'order_id' => $order_id,
                    'product_id' => $cart->product_id,
                    'product_price' => $cart->rel_to_product->discount_price,
                    // 'color_id' => $cart->color_id,
                    'size' => $cart->size,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);
                Cart::find($cart->id)->delete();
            }
            return back()->with('ordered', 'Ordered placed succesfully');
        } else {
            return back()->with('notavailable_cart', 'Not available product in your cart.');
        }
    }
}
