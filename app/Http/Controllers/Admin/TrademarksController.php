<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trademark;

class TrademarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = Trademark::orderByDesc('created_at')->get();
        return view('backend.admin.trademark.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.admin.trademark.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Trademark $trademark)
    {

        $request->validate([
            'name'        => 'required',
        ]);
        $trademark->create($request->all());
        return redirect()->route('admin.trademark.index')->with('message', "Data Added Successfully!");
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
    public function edit(Trademark $trademark)
    {

        return view('backend.admin.trademark.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trademark $trademark)
    {

        $request->validate([
            'name'        => 'required',
        ]);
        $trademark->update($request->all());
        return redirect()->route('admin.trademark.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trademark $trademark)
    {

        $trademark->delete();
        return redirect()->route('admin.trademark.index')->with('warning', "Data Deleted Successfully!");
    }
}
