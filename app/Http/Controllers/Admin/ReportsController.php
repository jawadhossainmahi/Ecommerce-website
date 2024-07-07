<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\SearchKeyword;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function popular_products(){
        $list = Product::select('id','name', 'popularity')->orderBy('popularity','desc')->get();
        return view('backend.admin.reports.popular_products', get_defined_vars());
    }
    public function searched_keywords(){
        $list = SearchKeyword::latest()->get();
        return view('backend.admin.reports.searched_keywords', get_defined_vars());
    }
    public function purchased_products(){
        $list = Product::select('id','name')->with(['orderDetails' => function($q){
            $q->sum('qty');
        }])->get();
        return view('backend.admin.reports.purchased_products', get_defined_vars());
    }
}
