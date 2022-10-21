<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart(){
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('cart', [
            'carts' => $carts,
        ]);
    }
    function checkout(){
        return view('checkout');
    }
}
