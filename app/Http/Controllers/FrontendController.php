<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function index() {
        $products = Product::all();
        $categories = Category::all();
        return view('welcome', [
            'products' => $products,
            'categories' => $categories,
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

    public function filter_on_category(Request $request){
        $all_products = '';
        if($request->category_id != 1) {
            $filter_products = Product::where('category_id', $request->category_id)->get();
            foreach($filter_products as $product) {
                $all_products .= '<div class="card card-compact bg-base-100 shadow-xl">
                        <a href="'.route('product.details', $product->id).'" class="cursor-pointer">
                            <img class="w-full" src="'.asset('uploads/products').'/'.$product->product_image.'"
                                class="rounded" alt="'.asset('uploads/products').'/'.$product->product_image.'" />
                        </a>
                        <div class="card-body">
                            <h2 class="text-2xl uppercase text-gray-900 font-bold">'.$product->product_name .'</h2>
                            <p class="uppercase text-sm text-gray-500">'.$product->description.'</p>
                            <div class="flex gap-4 w-14 items-center">
                                <p class="font-bold text-lg text-[#fb5d5d]">
                                    <b>৳</b><span>'.$product->discount_price.'</span>
                                </p>
                                <p class="font-semibold text-md text-gray-500">
                                    <del><b>৳</b><span>'.$product->product_price.'</span></del>
                                </p>
                            </div>
                            <div class="card-actions justify-center">
                                <a href="'.route('product.details', $product->id).'"
                                    class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-red-500 hover:text-white border-2 border-red-500 focus:outline-none">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>';
              }
            
        }
        else {
            $products = Product::all();
            foreach($products as $product) {
                $all_products .= '<div class="card card-compact bg-base-100 shadow-xl">
                        <a href="'.route('product.details', $product->id).'" class="cursor-pointer">
                            <img class="w-full" src="'.asset('uploads/products').'/'.$product->product_image.'"
                                class="rounded" alt="'.asset('uploads/products').'/'.$product->product_image.'" />
                        </a>
                        <div class="card-body">
                            <h2 class="text-2xl uppercase text-gray-900 font-bold">'.$product->product_name .'</h2>
                            <p class="uppercase text-sm text-gray-500">'.$product->description.'</p>
                            <div class="flex gap-4 w-14 items-center">
                                <p class="font-bold text-lg text-[#fb5d5d]">
                                    <b>৳</b><span>'.$product->discount_price.'</span>
                                </p>
                                <p class="font-semibold text-md text-gray-500">
                                    <del><b>৳</b><span>'.$product->product_price.'</span></del>
                                </p>
                            </div>
                            <div class="card-actions justify-center">
                                <a href="'.route('product.details', $product->id).'"
                                    class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-red-500 hover:text-white border-2 border-red-500 focus:outline-none">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>';
              }
            

        }
        echo $all_products;
    }
}
