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

class CategoryController extends Controller
{
    public function index()
    {

        $sub_cat = [];
        $subsub_cat = [];
        $product = Product::with('getcategory');
        if (request()->category) {
            $sub_cat = SubCategory::where('category_id', request()->category)->get();
            
            $product =  $product->where('category_id', request()->category);
        }
        if (request()->offer) {
            $sub_cat = SubCategory::where('category_id', request()->offer)->get();

            $product =  $product->where('category_id', request()->offer, "AND")->where('discount_price', '>', 0);
        }
        if (request()->subcat) {
            $subsub_cat = SubSubCat::where('sub_cat_id', request()->subcat)->get();

            $product =  $product->where('sub_cat_id', request()->subcat);
        }
        $product =  $product->orderBy('name', 'DESC')->get();

        $categories = Category::get();
        $category = Category::where('id', request()->category)->get();
        $trademarks = Trademark::all();
        $origins = Origin::all();
        // return view('frontend.category', ['categories', $categories] );
        return view('frontend.category', get_defined_vars());
    }
}
