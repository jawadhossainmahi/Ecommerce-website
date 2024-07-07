<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

use App\Models\Category;
use Illuminate\View\View;

class TestController extends Controller
{
  public function index(Request $request)
  {



    if ($request->ajax()) {
      $product_weekly = Product::where('items_status', 'Weekly')->with('getcategory', 'image')->get();
      $product_popular = Product::where('items_status', 'Popular')->take($request->data + 10)->with('getcategory', 'image')->get();
      $view = View::make('frontend.index', compact('product_weekly', 'product_popular'));
      $sections = $view->renderSections();
      return $sections['content'];
    }
    $product_weekly = Product::where('items_status', 'Weekly')->with('getcategory', 'image')->get();
    $product_popular = Product::where('items_status', 'Popular')->take(20)->with('getcategory', 'image')->get();

    $categories = Category::get();
    return view('frontend.test', get_defined_vars());
  }
  public function showproduct(Request $request)
  {
    $product = Product::all();
    $product = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
    $search = $request->search;
    //   return response()->json([
    //      'product' => $product
    //   ]);


    $categories = Category::get();
    return view('frontend.search', get_defined_vars());
  }
  public function display_product(Request $request)
  {

    // return $request;

    if ($request->ajax()) {
      $product =  Product::where('id', $request->id)->with('image')->first();
      $next = Product::where('items_status', $request->type, "AND")->where('id', '>', $product->id)->min('id');
      $pre = Product::where('items_status', $request->type, "AND")->where('id', '<', $product->id)->max('id');
      $data = [];
      $data['product'] = $product;
      $data['pre'] = $pre;
      $data['next'] = $next;
      return $data;
    }

    $categories = Category::get();
    return view('frontend.test', get_defined_vars());
  }
}
