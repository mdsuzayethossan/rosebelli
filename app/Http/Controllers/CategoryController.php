<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $trashed_categories = category::onlyTrashed()->get();
        return view('admin.category', [
            'categories' => $categories,
            'trashed_categories' => $trashed_categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('category_success', 'Category Added Successfully');
    }
    public function category_update(CategoryRequest $request)
    {
        Category::where('id', $request->id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('category_updated', 'Category Updated Successfully');
    }
    public function category_delete($id)
    {
        category::find($id)->delete();
        return back()->with('category_delete', 'Category deleted successfully');
    }
    public function category_forece_delete($id)
    {
        category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('category_force_delete', 'Category item permanent deleted successfully');
    }
    public function category_restore($id)
    {
        Category::withTrashed()->find($id)->restore();
        return back()->with('category_restore', 'Category restore sucessfully');
    }

}
