<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubSubCat;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function index()
    {
        $list = SubSubCat::orderByDesc('created_at')->get();
        return view('backend.admin.subsubcat.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $car_category = SubCategory::latest()->get();
        return view('backend.admin.subsubcat.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubSubCat $subsubcat)
    {
        $request->validate([
            'name'        => 'required',
        ]);
        $subsubcat->create($request->all());
        return redirect()->route('admin.subsubcat.index')->with('message', "Data Added Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubSubCat $subsubcat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubSubCat $subsubcat)
    {
        $car_category = SubCategory::latest()->get();
        return view('backend.admin.subsubcat.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSubCat $subsubcat)
    {
        $request->validate([
            'name'        => 'required',
        ]);
        $subsubcat->update($request->all());
        return redirect()->route('admin.subsubcat.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubSubCat $subsubcat)
    {
        $subsubcat->delete();
        return redirect()->route('admin.subsubcat.index')->with('warning', "Data Deleted Successfully!");
    }
}
