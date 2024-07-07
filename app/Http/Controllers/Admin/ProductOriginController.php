<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrigin;

class ProductOriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = ProductOrigin::get();
        return view('backend.admin.productorigin.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.admin.productorigin.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductOrigin $productorigin)
    {

        $request->validate([
            'name'        => 'required',
        ]);
        $productorigin->create($request->all());
        return redirect()->route('admin.productorigin.index')->with('message', "Data Added Successfully!");
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
    public function edit(ProductOrigin $productorigin)
    {

        return view('backend.admin.productorigin.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOrigin $productorigin)
    {

        $request->validate([
            'name'        => 'required',
        ]);
        $productorigin->update($request->all());
        return redirect()->route('admin.productorigin.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOrigin $productorigin)
    {

        $productorigin->delete();
        return redirect()->route('admin.productorigin.index')->with('warning', "Data Deleted Successfully!");
    }
}
