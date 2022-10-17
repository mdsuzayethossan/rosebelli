<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
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
        $subcategories = Subcategory::all();
        $trashed_subcategories = Subcategory::onlyTrashed()->get();
        return view('admin.subcategory', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'trashed_subcategories' => $trashed_subcategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
        if (Subcategory::withTrashed()->where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('subnameexist', 'Subcategory name already exist');
        } else {
            Subcategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
            return back()->with('insert', 'Subcategory Added Successfully');
        }
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Subcategory::where('id', $request->id)->update([
            'subcategory_name' => $request->subcategory_name,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('updated', 'Subcategory Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return back()->with('delete', 'Subcategory deleted successfully');
    }
    public function subcategory_forcedelete(Request $request)
    {
        Subcategory::where('id', $request->delete_id)->forceDelete();
        return back()->with('force_delete', 'Subcategory permanent deleted successfully');
    }
    public function restore($id){
        Subcategory::withTrashed()->find($id)->restore();
        return back()->with('restore', 'Subcategory restore sucessfully');
    }
}
