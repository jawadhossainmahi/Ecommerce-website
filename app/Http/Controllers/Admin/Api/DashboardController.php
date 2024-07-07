<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;

class DashboardController extends Controller
{
    public function ordersIntervalStatus($interval, $status = null, $get_total = false)
    {
        // dd($interval, $status, $get_total);

        $order = Orders::ByInterval($interval, $status, $get_total)->get();
        return response()->json($order);
    }
    public function customersInterval($interval)
    {
        $user = User::CustomersInterval($interval)->get();
        return response()->json($user);
    }
    public function orderspay($interval, $status = null, $get_total = false)
    {
        // dd($interval, $status, $get_total);

        $order = Orders::ByInterval($interval, $status, $get_total)->get();
        return  view('backend.admin.order.totalpayment', get_defined_vars());
    }
}
