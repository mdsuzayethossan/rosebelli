<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductOrder;

class AdminGeneralController extends Controller
{
    function banner()
    {
        $banners = Banner::all();
        return view('admin.banner', [
            'banners' => $banners,
        ]);
    }
    function banner_store(Request $request)
    {
        Banner::create([
            'title' => $request->banner_title,
            'btn_name' => $request->banner_button,
            'btn_link' => $request->banner_link,
            'description' => $request->description,
        ]);
        return back()->with('banner_insert', "Banner successfully added");
    }
    function banner_update(Request $request)
    {
        $id = $request->id;
        $bannerModel = Banner::where('id', $id);
        if ($request->banner_title == '' && $request->banner_button == '' && $request->btn_link == '' && $request->description == '') {
            return back()->with('notUpdatedbanner', 'Nothing has been updated!');
        } else {
            if ($request->banner_title != '') {
                $bannerModel->update([
                    'title' => $request->banner_title,
                ]);
            }
            if ($request->banner_button != '') {
                $bannerModel->update([
                    'btn_name' => $request->banner_button,
                ]);
            }
            if ($request->banner_link != '') {
                $bannerModel->update([
                    'btn_link' => $request->banner_link,
                ]);
            }
            if ($request->description != '') {
                $bannerModel->update([
                    'description' => $request->description,
                ]);
            }
            return back()->with('banner_update', "Banner successfully updated");
        }
    }
    function view_order()
    {
        $orders = Order::all();
        return view('admin.view-order', [
            'orders' => $orders,
        ]);
    }
    public function ordered_products($id)
    {
        $ordered_products = ProductOrder::where('order_id', $id)->get();
        return view('admin.ordered-products', [
            'ordered_products' => $ordered_products,
        ]);
    }
}
