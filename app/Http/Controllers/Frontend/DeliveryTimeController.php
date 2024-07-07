<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;

class DeliveryTimeController extends Controller
{
    public function store(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        // dd($request);
        $time = explode("-", $request->time);
        // dd($time);
        $start_time = $time[0];
        $end_time = $time[1];
        $_SESSION['delivery_datetime'] = ["delivery_date" => $request->date, "start_time" => $start_time, "end_time" => $end_time];
        // dd($_SESSION['delivery_datetime']);
        return redirect()->back();
    }

    public function show()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['delivery_datetime'])) {
            $_SESSION['delivery_datetime'] = array();
        }
        return response()->json($_SESSION['delivery_datetime']);
    }
}
