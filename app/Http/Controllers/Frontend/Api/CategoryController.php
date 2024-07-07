<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $sortby = $request->get('sortby') ?? 'popularity';
        // $products = Product::when(request()->has('origin_id') && request()->origin_id !== 'null', function ($query) {
        //     $query->where('origin_id', request()->origin_id);
        // })->when(request()->has('trademark_id') && request()->trademark_id !== 'null', function ($query) {
        //     $query->whereHas('gettrademarks', function ($query) {
        //         $query->where('trademark_id', request()->trademark_id);
        //     });
        // })->where('category_id', $request->category_id)->orderBy('name', 'asc')
        //     ->get();
        $products = Product::where('category_id', $request->category_id)->where('status', 'In Stock')->sortby($sortby)->take(24)->get();
        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }

    public function sub(Request $request)
    {
        $sortby = $request->get('sortby') ?? 'popularity';
        $products = Product::where('sub_cat_id', $request->sub_category_id)->where('status', 'In Stock')->sortby($sortby)->take(24)->get();
        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }

    public function subsub(Request $request)
    {
        $sortby = $request->get('sortby') ?? 'popularity';
        $products = Product::where('subsub_cat_id', $request->subsub_category_id)->where('status', 'In Stock')->sortby($sortby)->take(24)->get();
        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }
    public function LoadMoreCategory(Request $request)
    {
        $cat_id = $request->categoryId;
        $offset = $request->offset;
        $sortby = $request->get('sortby') ?? 'popularity';
        $loadproducts = Product::where('category_id', $cat_id)->where('status', 'In Stock')->sortby($sortby)->skip($offset)->take(24)->get();
        $formated_data = api_data_format($loadproducts, $request->mainId);
        return response($formated_data);
    }

    // sub category load more
    public function LoadMoreSub(Request $request)
    {

        // return response($request);
        $sub_id = $request->subId;
        $offset = $request->offset;
        $sortby = $request->get('sortby') ?? 'popularity';
        
        $loadproducts = Product::where('sub_cat_id', $sub_id)->where('status', 'In Stock')->sortby($sortby)->skip($offset)->take(24)->get();
        $formated_data = api_data_format($loadproducts, $request->mainId);
        return response($formated_data);
    }
    // subsub category load more

    public function LoadMoreSubSub(Request $request)
    {

        // return response($request);
        $subsub_id = $request->subsubId;
        $offset = $request->offset;
        $sortby = $request->get('sortby') ?? 'popularity';
        $loadproducts = Product::where('subsub_cat_id', $subsub_id)->where('status', 'In Stock')->sortby($sortby)->skip($offset)->take(24)->get();
        $formated_data = api_data_format($loadproducts, $request->mainId);
        return response($formated_data);
    }

    
}
