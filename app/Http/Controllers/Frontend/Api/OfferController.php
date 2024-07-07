<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $sortyBy = $request->get('sortby') ?? 'popularity';
        $products = Product::where('discount_price', '>', '0')->where('status', 'In Stock')->sortBy($sortyBy)->take(24)->get();

        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }
    public function loadhomeExtrapriser(Request $request)
    {

        // return response()->json($request->offset);
        $offset = $request->offset;
        $loadproducts = Product::where('discount_price', '>', '0')->where('status', 'In Stock')->skip($offset)->take(24)->get();
        $formated_data = api_data_format($loadproducts, $request->mainId);
        return response()->json($formated_data);
    }
}
