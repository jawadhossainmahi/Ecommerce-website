<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Orders;
use App\Models\Category;

class RecurringDeliveriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $recurring_orders = Orders::where('user_id', auth()->user()->id)->where('recurring_delivery', '!=', null)->orderBy('created_at', 'DESC')->get();
        return view('frontend.recurring-deliveries', get_defined_vars());
    }
}
