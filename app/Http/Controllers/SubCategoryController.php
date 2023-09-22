<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
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
        $subcategories = SubCategory::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.subcategory.index',compact('subcategories'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|min:2',
            'subcategory_des' => '',
            'category_id' => 'required',
            'status' => '',
        ]);

        if ($validated == true){
            $subcategory = new SubCategory([
                'subcategory_name' => $request->get('subcategory_name'),
                'subcategory_description' => $request->get('subcategory_des'),
                'status' => $request->get('status'),
                'category_id' => $request->get('category_id'),
            ]);
            $subcategory->save();
        }
        return redirect()->route('subcategories.index')->with('success','Subcategory has been created successfully.');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::get();
        return view('backend.subcategory.edit',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subcategory)
    {

        $validated = $request->validate([
            'subcategory_name' => 'required|min:2',
            'category_id' => 'required',
        ]);
//        dd($subcategory);
        if ($validated == true){
            $subcategory->subcategory_name = $request->get('subcategory_name');
            $subcategory->subcategory_description = $request->get('subcategory_des');
            $subcategory->status = $request->get('status');
            $subcategory->category_id = $request->get('category_id');
            $subcategory->save();
            return redirect()->route('subcategories.index')->with('success','Subcategory has been updated successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete(); // Easy right?

        return redirect()->route('subcategories.index')->with('success','Subcategory Deleted.');
    }
    public function restore($id)
    {
        SubCategory::where('id', $id)->withTrashed()->restore();

        return redirect()->route('subcategories.index')->with('Subcategory restored successfully.');
    }

    public function forceDelete($id)
    {
        SubCategory::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('subcategories.index')->with('Subcategory force deleted successfully.');
    }

}
