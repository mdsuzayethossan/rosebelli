<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Jorenvh\Share\Share;

class ProductDetailsController extends Controller
{
    public function details ($id) {
        $single_product = Product::find($id);
        $related_products = Product::where('product_group', $single_product->product_group)->where('id', '!=', $id)->get();
        $product_name =  $single_product->product_name;
        $currentURL = url()->current();
        $shareComponent = \Share::page(
            $currentURL,
            $product_name,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        return view('product-details',[
            'single_product' => $single_product,
            'related_products' => $related_products,
            'shareComponent' => $shareComponent
        ]);
    }
}
