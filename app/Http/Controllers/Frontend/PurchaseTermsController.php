<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class PurchaseTermsController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('frontend.purchaseterm', get_defined_vars());
    }
}
