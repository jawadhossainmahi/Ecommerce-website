<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class VeckansController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        // $veckans_products = Product::where('veckans_extrapriser', 1)
        //     ->where('veckans_qty', '>', 0)
        //     ->get();
        $veckans_products = [];

        return view('frontend.veckans', ['categories' => $categories, 'veckans_products' => $veckans_products]);
    }
}
