<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Origin;
use App\Models\SubCategory;
use App\Models\SubSubCat;
use App\Models\Trademark;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function index(Request $request)
    {

        $product = Product::with('getsubsubcategory');
        if (request()->sub_sub_category) {
            $product =  $product->where('subsub_cat_id', request()->sub_sub_category);
        }
        //   $sub_category = SubCategory::where('id', request())

        $product =  $product->get();
        $subsub_category = SubSubCat::where('id', request()->sub_sub_category)->get();
        $sub_category_id = 0;
        if (!$product->isEmpty()) {
            $sub_category_id = $product[0]->sub_cat_id;
        }


        $sub_category = SubCategory::where('id', $sub_category_id)->get();
        $categories = Category::get();
        $trademarks = Trademark::all();
        $origins = Origin::all();
        return view('frontend.subsub_category', get_defined_vars());
    }
}
