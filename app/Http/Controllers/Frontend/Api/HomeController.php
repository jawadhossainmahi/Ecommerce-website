<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Postcode;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCat;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        $sortyBy = $request->get('sortby') ?? 'popularity';
        $products = Product::where('status', 'In Stock')
            ->sortBy($sortyBy)
            ->take(24)->get();

        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }

    public function loadMoreProducts(Request $request, $offset)
    {
        $sortyBy = $request->get('sortby') ?? 'popularity';
        $products = Product::where('status', 'In Stock')->sortBy($sortyBy)->skip($offset)->take(24)->get();
        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }

    public function homeExtrapriser(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $products = Product::where('discount_price', '>', 0)->where('status', 'In Stock')->limit(24)->get();
        $formated_data = api_data_format($products, $request->mainId);

        return response()->json($formated_data);
    }


    public function authenticated_index()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $products = Product::where('status', 'In Stock')->get();
        $formated_data = api_data_format($products);

        return response()->json($formated_data);
    }

    public function load_offer_product_by_discount(Request $request)
    {
        $sub_cat = [];
        $subsub_cat = [];
        $sortyBy = $request->get('sortby') ?? 'popularity';
        $title = "Denna veckans erbjudande";
        $All_product = Product::with('getcategory');
        $bradcrumb = [];
        if ($request->category_id) {
            $sub_cat = SubCategory::where('category_id', request()->category_id)->get();
            $product = $All_product->where("category_id", $request->category_id);
            $title = Category::where("id", $request->category_id)->get("name")[0]->name;
            $category1 = Category::where("id", $request->category_id)->get()->toArray();
            $bradcrumb = array_merge($bradcrumb, $category1);
        }

        if (request()->subcat) {
            $category1 = Category::where("id", $request->old_category_id)->get()->toArray();
            $category2 = SubCategory::where("id", $request->subcat)->get()->toArray();
            $bradcrumb = array_merge($bradcrumb, $category1, $category2);
            $subsub_cat = SubSubCat::where('sub_cat_id', request()->subcat)->get();
            $product = $All_product->where('sub_cat_id', request()->subcat);

            $title = SubCategory::where("id", $request->subcat)->get("name")[0]->name;
        }
        if (request()->subsubcat) {

            $product = $All_product->where('subsub_cat_id', request()->subsubcat);

            $title = SubSubCat::where("id", $request->subsubcat)->get("name")[0]->name;
            $category1 = Category::where("id", $request->old_category_id)->get()->toArray();
            $category2 = SubCategory::where("id", $request->old_sub_category_id)->get()->toArray();
            $category3 = SubSubCat::where("id", $request->subsubcat)->get()->toArray();
            $bradcrumb = array_merge($bradcrumb, $category1, $category2, $category3);
        }
        if (!$request->category_id && !$request->subcat && !$request->subsubcat) {
            $product = $All_product->where("discount_price", "!=", "0");
        }
        $categories = Category::get();

        $product = $All_product->sortBy($sortyBy)->where('status', 'In Stock')->take(24)->get();
        $formated_data = api_data_format($product);

        return response()->json(get_defined_vars());
    }

    public function load_more_home_product_by_category_and_discount(Request $request, $offset)
    {


        $sub_cat = [];
        $subsub_cat = [];
        $sortyBy = $request->get('sortby') ?? 'popularity';
        $title = "Denna veckans erbjudande";
        $All_product = Product::with('getcategory');
        $bradcrumb = [];
        if ($request->category_id) {
            $sub_cat = SubCategory::where('category_id', request()->category_id)->get();
            $product = $All_product->where("category_id", $request->category_id);
            $title = Category::where("id", $request->category_id)->get("name")[0]->name;
            $category1 = Category::where("id", $request->category_id)->get()->toArray();
            $bradcrumb = array_merge($bradcrumb, $category1);
        }

        if (request()->subcat) {
            $category1 = Category::where("id", $request->old_category_id)->get()->toArray();
            $category2 = SubCategory::where("id", $request->subcat)->get()->toArray();
            $bradcrumb = array_merge($bradcrumb, $category1, $category2);
            $subsub_cat = SubSubCat::where('sub_cat_id', request()->subcat)->get();
            $product = $All_product->where('sub_cat_id', request()->subcat);

            $title = SubCategory::where("id", $request->subcat)->get("name")[0]->name;
        }
        if (request()->subsubcat) {

            $product = $All_product->where('subsub_cat_id', request()->subsubcat);

            $title = SubSubCat::where("id", $request->subsubcat)->get("name")[0]->name;
            $category1 = Category::where("id", $request->old_category_id)->get()->toArray();
            $category2 = SubCategory::where("id", $request->old_sub_category_id)->get()->toArray();
            $category3 = SubSubCat::where("id", $request->subsubcat)->get()->toArray();
            $bradcrumb = array_merge($bradcrumb, $category1, $category2, $category3);
        }

        $categories = Category::get();

        $product = $All_product->sortBy($sortyBy)->where('status', 'In Stock')->skip($offset)->take(24)->get();
        $formated_data = api_data_format($product);


        // $sortyBy = $request->get('sortby') ?? 'popularity';
        // $All_product = Product::with('getcategory');

        // // $products = Product::where('status', 'In Stock')->sortBy($sortyBy)->skip($offset)->take(24)->get();
        // if ($request->category_id) {
        //     $product = $All_product->where("category_id", $request->category_id);
        // }
        // if ($request->subcat) {
        //     $product = $All_product->where("sub_cat_id", $request->subcat);
        // }
        // if ($request->subsubcat) {
        //     $product = $All_product->where("subsub_cat_id", $request->subsubcat);
        // }
        // $product = $All_product->where("discount_price", "!=", "0")->where('status', 'In Stock')->where("discount_price", "!=", "0")->sortBy($sortyBy)->skip($offset)->take(24)->get();


        // $formated_data = api_data_format($product);
        return response()->json(get_defined_vars());
    }
    // public function loadhomeExtrapriser(Request $request){
    //     if(session_status() === PHP_SESSION_NONE) session_start();
    //     // return response($request);
    //     $offset=$request->offset;
    //     $loadproducts=Product::where('discount_price', '>','0')->where('status', 'In Stock')->orderBy('name')->skip($offset)->take(20)->get();
    //     $formated_data = api_data_format($loadproducts, $request->mainId);
    //     return response($formated_data);

    // }


    public function get_category_data(Request $request)
    {
        if ($request->subcat) {
            $category = SubCategory::where("id", $request->subcat)->get();
        }
        if ($request->subsubcat) {
            $category = SubSubCat::where("id", $request->subsubcat)->get();
        }
        if ($request->category_id) {
            $category = Category::where("id", $request->category_id)->get();
        }
        return response()->json(get_defined_vars());
    }


    public function get_session_data_as_json($name)
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        // unset($_SESSION["$name"]);
        $data = null;
        if (isset($_SESSION["$name"])) {
            return response()->json($_SESSION["$name"]);
        }
        return $data;
    }
}
