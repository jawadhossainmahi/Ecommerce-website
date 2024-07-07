<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;
use App\Models\OrderDeliveryTime;

class DeliveryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = DeliveryTime::orderByDesc('created_at')->get();
        //  dd($list[0]->getorderdeliverytime());
        //  $list = DeliveryTime::get();
        return view('backend.admin.deliverytime.index', get_defined_vars());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postcode  $deliverytime
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $list = DeliveryTime::where('date', $request->date)->get();
        return view('backend.admin.deliverytime.show', get_defined_vars());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.deliverytime.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'        => 'required',
        ]);
        $start_time = ($request->start_time) ? $request->start_time : 0;
        $end_time = ($request->end_time) ? $request->end_time : "24:0:0";
        $deliverytime = DeliveryTime::where('date', $request->date)->where('start_time', $start_time)->where('end_time', $end_time)->first();
        if ($deliverytime) {
            $deliverytime->status = ($deliverytime->status) ? 0 : 1;
            $deliverytime->save();
        } else {

            $deliverytime = new DeliveryTime();
            $deliverytime->start_time = $start_time;
            $deliverytime->end_time = $end_time;
            $deliverytime->date = $request->date;
            $deliverytime->status = 0;
            $deliverytime->save();
        }
        return response()->json(200);
        // return redirect()->route('admin.deliverytime.index')->with('message',"Data Added Successfully!");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postcode  $deliverytime
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryTime $deliverytime)
    {
        $deliverytime = DeliveryTime::where('id', $deliverytime->id)->get();
        return view('backend.admin.deliverytime.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postcode  $deliverytime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryTime $deliverytime)
    {
        $request->validate([
            'time'        => 'required',
            'date'        => 'required',

        ]);
        $deliverytime = DeliveryTime::where('id', $deliverytime->id)->get();
        $deliverytime[0]->time = $request->time;
        $deliverytime[0]->date = $request->date;
        $deliverytime[0]->save();
        return redirect()->route('admin.deliverytime.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postcode  $deliverytime
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryTime $deliverytime)
    {
        $deliverytime->delete();
        return redirect()->route('admin.deliverytime.index')->with('warning', "Data Deleted Successfully!");
    }

    // disable on click checkbox 

    public function disables(Request $request, $id)
    {
        $all = $request->id;
        $data = DeliveryTime::where('date', $all)->get();

        foreach ($data as $key => $value) {

            $time = DeliveryTime::where('date', $value->date)->update(['status' => 1]);
        }
    }
    // enable button
    // public function enables(Request $request ,$id){
    //   $alls=$request->id;
    // $datas=DeliveryTime::where('date',$alls)->get();

    // foreach($datas as $key => $value){
    //   $times=DeliveryTime::where('date', $value->date)->update(['status'=>0]);
    //   print_r($time);
    // }

    // }

    public function enables(Request $request, $id)
    {
        $all = $request->id;
        $data = DeliveryTime::where('date', $all)->get();

        foreach ($data as $key => $value) {

            $time = DeliveryTime::where('date', $value->date)->update(['status' => 0]);
        }
    }
}
