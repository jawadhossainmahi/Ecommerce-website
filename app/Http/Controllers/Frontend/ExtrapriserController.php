<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class ExtrapriserController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $discounted_products = Product::where('discount_price', '!=', '0')->get();
        return view('frontend.extrapriser', ['categories' => $categories, 'discounted_products' => $discounted_products]);
    }
}
