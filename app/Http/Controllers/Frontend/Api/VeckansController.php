<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class VeckansController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('status', 'In Stock')
        ->where('veckans_extrapriser', 1)
        // ->where('veckans_qty', '>', 0)
        ->take(24)->get();

        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }
    public function loadVeckansExtrapriser(Request $request)
    {

        $offset = $request->offset;
        $loadproducts = Product::where('status', 'In Stock')
        ->where('veckans_extrapriser', 1)
        // ->where('veckans_qty', '>', 0)
        ->skip($offset)->take(24)->get();
        $formated_data = api_data_format($loadproducts, $request->mainId);
        return response()->json($formated_data);
    }
}
