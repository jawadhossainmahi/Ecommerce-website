<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Models\SearchKeyword;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index($id = null)
    {

        $data = [];


        if ($id) {
            $products = Product::when(request()->has('origin_id') && request()->origin_id !== 'null', function ($query) {
                $query->where('origin_id', request()->origin_id);
            })->where('status', 'In Stock')->where("id", $id)->get();
        } else {
            $products = Product::when(request()->has('origin_id') && request()->origin_id !== 'null', function ($query) {
                $query->where('origin_id', request()->origin_id);
            })->where('status', 'In Stock')->get();
        }

        // $formated_data = api_data_format($products);
        // return response()->json($formated_data);

        foreach ($products as $product) {
            $image = env("BASE_URL") . "frontend/images/no-item.png";
            if ($product->images->isNotEmpty()) {
                $image = env("BASE_URL") . "" . $product->images[0]->path;
            }
            ;
            $product_category = null;
            $product_category_id = null;

            if (!empty($product->getcategory->toArray())) {
                $product_category_id = $product->getcategory->id;
                $product_category = $product->getcategory->name;
            }
            $getsubcategory = null;
            $getsubcategory_id = null;
            if (!empty($product->getsubcategory->toArray())) {

                $getsubcategory_id = $product->getsubcategory[0]->id;
                $getsubcategory = $product->getsubcategory[0]->name;
            }
            $getsubsubcategory = null;
            $getsubsubcategory_id = null;

            if (!empty($product->getsubsubcategory->toArray())) {
                $getsubsubcategory_id = $product->getsubsubcategory[0]->id;
                $getsubsubcategory = $product->getsubsubcategory[0]->name;
            }
            $is_favourite = false;
            if (auth()->check()) {
                $is_favourite = auth()->user()->is_favourite($product->id);
            }
            $item_qty = 0;
            if (isset($_SESSION['cart'])) {
                if (array_key_exists($product->id, $_SESSION['cart'])) {
                    $item_qty = $_SESSION['cart'][$product->id];
                }
            }

            if (!strlen(filter_var($product->product_information, FILTER_SANITIZE_STRING))) {
                $product->product_information = null;
            }
            if (!strlen(filter_var($product->ingredients, FILTER_SANITIZE_STRING))) {
                $product->ingredients = null;
            }
            if (!strlen(filter_var($product->storage, FILTER_SANITIZE_STRING))) {
                $product->storage = null;
            }
            if (!strlen(filter_var($product->other_information, FILTER_SANITIZE_STRING))) {
                $product->other_information = null;
            }
            if (!strlen(filter_var($product->nutritional_content, FILTER_SANITIZE_STRING))) {
                $product->nutritional_content = null;
            }
            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product_category_id,
                'category' => $product_category,
                'sub_category_id' => $getsubcategory_id,
                'sub_category' => $getsubcategory,
                'subsub_category_id' => $getsubsubcategory_id,
                'subsub_category' => $getsubsubcategory,
                'is_favourite' => $is_favourite,
                'cart_quantity' => $item_qty,
                'product_information' => $product->product_information,
                'origin' => $product->getorigin->name ?? null,
                'image' => $image,
                'ingredients' => $product->ingredients,
                'nutritional_content' => $product->nutritional_content,
                'storage' => $product->storage,
                'other_information' => $product->other_information,
                'buy_two_for' => $product->buy_two_get ? true : false,
                'buy_two' => $product->buy_two_get ? true : false,
                'price' => $product->price,
                'price_per_item' => $product->price_per_item,
                'compare_price' => $product->compare_price,
                'pant' => $product->pant ?? null,
                'status' => $product->status,
                'weight' => $product->weight,
                'item_status' => $product->item_status,
                'discount_price' => $product->discount_price,
                "tax" => $product->tax,

            ];
            $data[$product->id] = $item;
        }

        return response()->json([
            'data' => [
                $data
            ]
        ]);
    }

    public function filter(Request $request)
    {
        $data = [];
        $parameters = $request->all();
        $query = Product::query();
        foreach ($parameters as $key => $val) {
            $query = $query->where($key, $val);
        }
        $filtered_products = Product::where('status', 'In Stock')->get();
        foreach ($filtered_products as $product) {
            $image = env("BASE_URL") . "frontend/images/no-item.png";
            if ($product->images->isNotEmpty()) {
                $image = env("BASE_URL") . "" . $product->images[0]->path;
            }
            ;
            $product_category = null;
            $product_category_id = null;

            if (!empty($product->getcategory->toArray())) {
                $product_category_id = $product->getcategory->id;
                $product_category = $product->getcategory->name;
            }
            $getsubcategory = null;
            $getsubcategory_id = null;
            if (!empty($product->getsubcategory->toArray())) {

                $getsubcategory_id = $product->getsubcategory[0]->id;
                $getsubcategory = $product->getsubcategory[0]->name;
            }
            $getsubsubcategory = null;
            $getsubsubcategory_id = null;
            if (!empty($product->getsubsubcategory->toArray())) {
                $getsubsubcategory_id = $product->getsubsubcategory[0]->id;
                $getsubsubcategory = $product->getsubsubcategory[0]->name;
            }
            $is_favourite = false;
            if (auth()->check()) {
                $is_favourite = auth()->user()->is_favourite($product->id);
            }
            $item_qty = 0;
            if (isset($_SESSION['cart'])) {
                if (array_key_exists($product->id, $_SESSION['cart'])) {
                    $item_qty = $_SESSION['cart'][$product->id];
                }
            }
            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product_category_id,
                'category' => $product_category,
                'sub_category_id' => $getsubcategory_id,
                'sub_category' => $getsubcategory,
                'subsub_category_id' => $getsubsubcategory_id,
                'subsub_category' => $getsubsubcategory,
                'cart_quantity' => $item_qty,
                'is_favourite' => $is_favourite,
                'product_information' => $product->product_information,
                'origin' => $product->getorigin->name ?? null,
                'image' => $image,
                'ingredients' => $product->ingredients,
                'nutritional_content' => $product->nutritional_content,
                'storage' => $product->storage,
                'other_information' => $product->other_information,
                'buy_two_for' => $product->buy_two_for,
                'price' => $product->price,
                'price_per_item' => $product->price_per_item,
                'compare_price' => $product->compare_price,
                'pant' => $product->pant ?? null,
                'status' => $product->status,
                'weight' => $product->weight,
                'item_status' => $product->item_status,
                'discount_price' => $product->discount_price,

            ];
            $data[$product->id] = $item;
        }

        return response()->json($data);
    }

    public function search(Request $search)
    {
        $data = [];
        $keyword = trim($search['search']);
        if (in_array($keyword, ['&'])) {
            return response()->json([]);
        }
        $search = filterStringToArray($keyword);
        // $products = Product::with(["images", "getcategory", "getsubcategory", "getsubsubcategory"])->where('status', 'In Stock')->where('name', 'like', '%' . $search . '%')->take(24)->dd();

        $products = Product::with(["images", "getcategory", "getsubcategory", "getsubsubcategory"])
            ->where('status', 'In Stock')
            ->where(function ($q) use ($search) {
                foreach ($search as $word) {
                    $q->orWhere('name', 'LIKE', '%' . $word . '%');
                }
            })
            ->take(24)->get();

        $categories = Category::whereNotNull('name')
            ->where(function ($q) use ($search) {
                foreach ($search as $word) {
                    $q->orWhere('name', 'LIKE', '%' . $word . '%');
                }
            })
            ->pluck('id');

        if ($categories) {
            $cat_products = Product::with(["images", "getcategory", "getsubcategory", "getsubsubcategory"])
                ->where('status', 'In Stock')
                ->whereIn('category_id', $categories)
                ->take(24)->get();

            $merged = $products->merge($cat_products);
            $products = $merged->all();
        }

        SearchKeyword::updateOrCreate(
            ['keyword' => trim($keyword)],
            []
        );

        $data = api_data_format($products);


        return response()->json($data);
    }
    public function loadmore(Request $request, $offset)
    {
        $search = $request->searchname;
        $data = [];
        // $search = $request['search'];
        $products = Product::with(["images", "getcategory", "getsubcategory", "getsubsubcategory"])->where('status', 'In Stock')->where('name', 'like', '%' . $search . '%')->skip($offset)->take(24)->get();

        $categories = Category::whereNotNull('name')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->pluck('id');

        if ($categories) {
            $cat_products = Product::with(["images", "getcategory", "getsubcategory", "getsubsubcategory"])
                ->where('status', 'In Stock')
                ->whereIn('category_id', $categories)
                ->take(24)->get();

            $merged = $products->merge($cat_products);
            $products = $merged->all();
        }

        $data = api_data_format($products);

        return response()->json($data);
    }
    //Point add for popular product
    public function popularity_point_add(Request $request)
    {
        if ($request->product_id && $request->type) {
            popularProductPoint($request->product_id, $request->type);
            return response()->json(200);
        }
        return response()->json(403);
    }


    public function admin_add_product_filters()
    {
        $data = [];


        // if (request()->has("product_filter_ids") && request()->product_filter_ids) {
        $products = Product::when(request()->has('origin_id') && request()->origin_id !== 'null', function ($query) {
            $query->where('origin_id', request()->origin_id);
        })->where('status', 'In Stock')->get();
        // } else {
        //     return "sorry";
        // }

        // $formated_data = api_data_format($products);
        // return response()->json($formated_data);

        foreach ($products as $product) {
            $image = env("BASE_URL") . "frontend/images/no-item.png";
            if ($product->images->isNotEmpty()) {
                $image = env("BASE_URL") . "" . $product->images[0]->path;
            }
            ;
            $product_category = null;
            $product_category_id = null;

            if (!empty($product->getcategory->toArray())) {
                $product_category_id = $product->getcategory->id;
                $product_category = $product->getcategory->name;
            }
            $getsubcategory = null;
            $getsubcategory_id = null;
            if (!empty($product->getsubcategory->toArray())) {

                $getsubcategory_id = $product->getsubcategory[0]->id;
                $getsubcategory = $product->getsubcategory[0]->name;
            }
            $getsubsubcategory = null;
            $getsubsubcategory_id = null;

            if (!empty($product->getsubsubcategory->toArray())) {
                $getsubsubcategory_id = $product->getsubsubcategory[0]->id;
                $getsubsubcategory = $product->getsubsubcategory[0]->name;
            }
            $is_favourite = false;
            if (auth()->check()) {
                $is_favourite = auth()->user()->is_favourite($product->id);
            }
            $item_qty = 0;
            if (isset($_SESSION['cart'])) {
                if (array_key_exists($product->id, $_SESSION['cart'])) {
                    $item_qty = $_SESSION['cart'][$product->id];
                }
            }

            if (!strlen(filter_var($product->product_information, FILTER_SANITIZE_STRING))) {
                $product->product_information = null;
            }
            if (!strlen(filter_var($product->ingredients, FILTER_SANITIZE_STRING))) {
                $product->ingredients = null;
            }
            if (!strlen(filter_var($product->storage, FILTER_SANITIZE_STRING))) {
                $product->storage = null;
            }
            if (!strlen(filter_var($product->other_information, FILTER_SANITIZE_STRING))) {
                $product->other_information = null;
            }
            if (!strlen(filter_var($product->nutritional_content, FILTER_SANITIZE_STRING))) {
                $product->nutritional_content = null;
            }
            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product_category_id,
                'category' => $product_category,
                'sub_category_id' => $getsubcategory_id,
                'sub_category' => $getsubcategory,
                'subsub_category_id' => $getsubsubcategory_id,
                'subsub_category' => $getsubsubcategory,
                'is_favourite' => $is_favourite,
                'cart_quantity' => $item_qty,
                'product_information' => $product->product_information,
                'origin' => $product->getorigin->name ?? null,
                'image' => $image,
                'ingredients' => $product->ingredients,
                'nutritional_content' => $product->nutritional_content,
                'storage' => $product->storage,
                'other_information' => $product->other_information,
                'buy_two_for' => $product->buy_two_for,
                'price' => $product->price,
                'price_per_item' => $product->price_per_item,
                'compare_price' => $product->compare_price,
                'pant' => $product->pant ?? null,
                'status' => $product->status,
                'weight' => $product->weight,
                'item_status' => $product->item_status,
                'discount_price' => $product->discount_price,

            ];
            $data[$product->id] = $item;
        }

        return response()->json([
            'data' => [
                $data
            ]
        ]);
    }


    public function get_products_for_checkout(Request $request)
    {

        $data = [];

        // return response()->json($request->all());

        if ($request->ids) {
            $products = Product::when(request()->has('origin_id') && request()->origin_id !== 'null', function ($query) {
                $query->where('origin_id', request()->origin_id);
            })->where('status', 'In Stock')->whereIn("id", $request->ids)->get();
        } else {
            return false;
        }

        // $formated_data = api_data_format($products);
        // return response()->json($formated_data);

        foreach ($products as $product) {
            $image = env("BASE_URL") . "frontend/images/no-item.png";
            if ($product->images->isNotEmpty()) {
                $image = env("BASE_URL") . "" . $product->images[0]->path;
            }
            ;
            $product_category = null;
            $product_category_id = null;

            if (!empty($product->getcategory->toArray())) {
                $product_category_id = $product->getcategory->id;
                $product_category = $product->getcategory->name;
            }
            $getsubcategory = null;
            $getsubcategory_id = null;
            if (!empty($product->getsubcategory->toArray())) {

                $getsubcategory_id = $product->getsubcategory[0]->id;
                $getsubcategory = $product->getsubcategory[0]->name;
            }
            $getsubsubcategory = null;
            $getsubsubcategory_id = null;

            if (!empty($product->getsubsubcategory->toArray())) {
                $getsubsubcategory_id = $product->getsubsubcategory[0]->id;
                $getsubsubcategory = $product->getsubsubcategory[0]->name;
            }
            $is_favourite = false;
            if (auth()->check()) {
                $is_favourite = auth()->user()->is_favourite($product->id);
            }
            $item_qty = 0;
            if (isset($_SESSION['cart'])) {
                if (array_key_exists($product->id, $_SESSION['cart'])) {
                    $item_qty = $_SESSION['cart'][$product->id];
                }
            }

            if (!strlen(filter_var($product->product_information, FILTER_SANITIZE_STRING))) {
                $product->product_information = null;
            }
            if (!strlen(filter_var($product->ingredients, FILTER_SANITIZE_STRING))) {
                $product->ingredients = null;
            }
            if (!strlen(filter_var($product->storage, FILTER_SANITIZE_STRING))) {
                $product->storage = null;
            }
            if (!strlen(filter_var($product->other_information, FILTER_SANITIZE_STRING))) {
                $product->other_information = null;
            }
            if (!strlen(filter_var($product->nutritional_content, FILTER_SANITIZE_STRING))) {
                $product->nutritional_content = null;
            }
            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product_category_id,
                'category' => $product_category,
                'sub_category_id' => $getsubcategory_id,
                'sub_category' => $getsubcategory,
                'subsub_category_id' => $getsubsubcategory_id,
                'subsub_category' => $getsubsubcategory,
                'is_favourite' => $is_favourite,
                'cart_quantity' => $item_qty,
                'product_information' => $product->product_information,
                'origin' => $product->getorigin->name ?? null,
                'image' => $image,
                'ingredients' => $product->ingredients,
                'nutritional_content' => $product->nutritional_content,
                'storage' => $product->storage,
                'other_information' => $product->other_information,
                'buy_two_for' => $product->buy_two_get ? true : false,
                'buy_two' => $product->buy_two_get ? true : false,
                'price' => $product->price,
                'price_per_item' => $product->price_per_item,
                'compare_price' => $product->compare_price,
                'pant' => $product->pant ?? null,
                'status' => $product->status,
                'weight' => $product->weight,
                'item_status' => $product->item_status,
                'discount_price' => $product->discount_price,
                "tax" => $product->tax,

            ];
            $data[$product->id] = $item;
        }

        return response()->json([
            'data' => [
                $data
            ]
        ]);
    }
}
