<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function checkout(){
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('checkout', [
            'carts' => $carts,
        ]);
    }
    function order(Request $request){
        if(cart::where('user_id', Auth::id())->count() > 0){
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'delivery_charge' => $request->delivery_charge,
                'total' => ($request->grand_total + $request->delivery_charge),
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now(),
            ]);
        }
        else {
            return back()->with('notavailable_cart', 'Not available product in your cart. Please add to cart');

        }
    }
}
