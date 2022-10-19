<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function index() {
        $products = Product::all();
        $carts = Cart::all();
        return view('welcome', [
            'products' => $products,
            'carts' => $carts
        ]);
    }
    public function add_cart(Request $request) {
        if(cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->exists()){
            cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
            echo "Product has been added to your cart";
        }
        else {
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        echo "Product has been added to your cart";
        }
    }
}
