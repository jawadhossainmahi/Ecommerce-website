<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;

class DeliveryTimeController extends Controller
{
    public function index()
    {
        $start_time = "0:00:00";
        $end_time = "24:00:00";
        $deliverytime = DeliveryTime::get();
        return response()->json($deliverytime);
    }

    public function show(Request $request)
    {
        $deliverytime = DeliveryTime::where('date', $request->date)->get();
        return response()->json($deliverytime);
    }

    public function alldeliverytimes()
    {
        $start_time = "0:00:00";
        $end_time = "24:00:00";
        $deliverytime = DeliveryTime::where('start_time', $start_time)->where('end_time', $end_time)->get();
        return response()->json($deliverytime);
    }
}
