<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliverySetting;
use Illuminate\Http\Request;

class DeliverySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliver_settings = DeliverySetting::first();
        return view('backend.admin.delivery_settings.index', compact('deliver_settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $delivery_settings = DeliverySetting::updateOrCreate(
            ['id' => 1],
            ['minimum_delivery_days' => $request->minimum_delivery_days]
        );
        return redirect()->route('admin.delivery_settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function get_minimum_delivery_days(){
        $deliver_settings = DeliverySetting::first();
        return response()->json($deliver_settings);
    }
}
