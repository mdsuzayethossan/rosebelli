<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function details ($id) {
        $single_product = Product::find($id);
        $related_products = Product::where('product_group', $single_product->product_group)->where('id', '!=', $id)->get();
        return view('product-details',[
            'single_product' => $single_product,
            'related_products' => $related_products,
        ]);
    }
}
