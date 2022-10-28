<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('cart', [
            'carts' => $carts,
        ]);
    }

    function cart_update(Request $request)
    {
        foreach ($request->qtybutton as $cart_id => $quantity)
            foreach ($request->size as $cart_id => $size)
                cart::find($cart_id)->update([
                    'quantity' => $quantity,
                    'size' => $size
                ]);
        return back()->with('cart_updated', 'Cart updated successfully');
    }
    function cart_delete($id)
    {
        Cart::find($id)->delete();
        return back()->with('cart_delete', 'Cart deleted successfully');
    }
}
