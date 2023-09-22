<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.category.index',compact('categories'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'category_name' => 'required|min:2',
            'category_des' => '',
            'status' => 'required',
        ]);
        if ($validated == true){
            $category = new Category([
                'category_name' => $request->get('category_name'),
                'category_description' => $request->get('category_des'),
                'status' => $request->get('status')
            ]);
            $category->save();
            return redirect()->route('categories.index')->with('success','Category has been created successfully.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|min:2',
            'category_des' => '',
            'status' => 'required',
        ]);

        if ($validated == true){

            $category->category_name = $request->get('category_name');
            $category->category_description = $request->get('category_des');
            $category->status = $request->get('status');
            $category->save();
            return redirect()->route('categories.index')->with('success','Category has been updated successfully.');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete(); // Easy right?

        return redirect()->route('categories.index')->with('success','Category Deleted.');
    }

    public function restore($id)
    {
        Category::where('id', $id)->withTrashed()->restore();

        return redirect()->route('categories.index')->with('Category restored successfully.');
    }

    public function forceDelete($id)
    {
        Category::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('categories.index')->with('Category force deleted successfully.');
    }
}
