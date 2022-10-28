<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function get_subcategory(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->category_id)->select('id', 'subcategory_name')->get();
        $str_to_send = '';
        foreach ($subcategories as $subcategory) {
            $str_to_send .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $str_to_send;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        $subcategories = Subcategory::all();
        $trashed_products = Product::onlyTrashed()->get();
        return view('admin.product', [
            'categories' => $categories,
            'products' => $products,
            'subcategories' => $subcategories,
            'trashed_products' => $trashed_products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product_id = Product::insertGetId([
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'product_name' => $request->product_name,
            'product_id' => uniqid(),
            'product_group' => $request->product_group,
            'product_price' => $request->product_price,
            'discount' => $request->discount,
            'discount_price' => $request->product_price - ($request->product_price * $request->discount) / 100,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $product_image = $request->product_image;
        $extension = $product_image->getClientOriginalExtension();
        $new_product_name = str::replace(' ', '_', ($request->product_name)) . '_' . $product_id . '.' . $extension;

        image::make($product_image)->save(public_path('/uploads/products/') . $new_product_name);
        Product::find($product_id)->update([
            'product_image' => $new_product_name,
        ]);
        return back()->with('product_added', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function pruduct_update(Request $request)
    {
        $id = $request->id;
        $findProductModel = Product::where('id', $id);
        if ($request->category == '' && $request->subcategory == '' && $request->product_name == '' && $request->product_group == '' && $request->product_price == '' && $request->discount == '' && $request->description == '' && $request->product_image == '') {
            return back()->with('notUpdatedProduct', 'Nothing has been updated!');
        } else {
            if ($request->category != '') {
                $findProductModel->update([
                    'category_id' => $request->category,
                ]);
            }
            if ($request->subcategory != '') {
                $findProductModel->update([
                    'subcategory_id' => $request->subcategory,
                ]);
            }
            if ($request->product_name != '') {
                $findProductModel->update([
                    'product_name' => $request->product_name,
                ]);
            }
            if ($request->product_group != '') {
                $findProductModel->update([
                    'product_group' => $request->product_group,
                ]);
            }
            if ($request->product_price != '') {
                $findProductModel->update([
                    'product_price' => $request->product_price,
                ]);
            }
            if ($request->discount != '') {
                $findProductModel->update([
                    'discount' => $request->discount,
                    'discount_price' => $request->product_price - ($request->product_price * $request->discount) / 100,
                ]);
            }
            if ($request->description != '') {
                $findProductModel->update([
                    'description' => $request->description,
                ]);
            }
            if ($request->product_image != '') {
                $old_image = Product::find($request->id)->product_image;
                $existing_image = public_path() . "/uploads/products/" . $old_image;
                if (is_file($existing_image)) {
                    unlink($existing_image);
                    $product_image = $request->product_image;
                    $extension = $product_image->getClientOriginalExtension();
                    $new_product_name = str::replace(' ', '_', ($request->product_name)) . '_' . $id . '.' . $extension;

                    image::make($product_image)->save(public_path('/uploads/products/') . $new_product_name);
                    $findProductModel->update([
                        'product_image' => $new_product_name,
                    ]);
                } else {
                    $product_image = $request->product_image;
                    $extension = $product_image->getClientOriginalExtension();
                    $new_product_name = str::replace(' ', '_', ($request->product_name)) . '_' . $id . '.' . $extension;

                    image::make($product_image)->save(public_path('/uploads/products/') . $new_product_name);
                    $findProductModel->update([
                        'product_image' => $new_product_name,
                    ]);
                }
            }
        }
        return back()->with('someProductFiled', 'Product updated successfully');
    }
    public function pruduct_delete(Request $request)
    {
        Product::where('id', $request->delete_id)->delete();
        return back()->with('product_delete', 'Product deleted successfully');
    }
    public function pruduct_force_delete(Request $request)
    {
        Product::onlyTrashed()->find($request->delete_id)->forceDelete();
        return back()->with('product_force_delete', 'Product item permanent deleted successfully');
    }
    public function product_restore($id)
    {
        Product::withTrashed()->find($id)->restore();
        return back()->with('product_restore', 'Product restore sucessfully');
    }
    public function view_product()
    {
        $categories = Category::all();
        $products = Product::all();
        $subcategories = Subcategory::all();
        $trashed_products = Product::onlyTrashed()->get();
        return view('admin.view-product', [
            'categories' => $categories,
            'products' => $products,
            'subcategories' => $subcategories,
            'trashed_products' => $trashed_products,
        ]);
    }
}
