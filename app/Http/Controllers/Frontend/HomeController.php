<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Postcode;
use App\Models\Category;
use App\Models\Origin;
use App\Models\SubCategory;
use App\Models\Trademark;
use App\Models\User;
use Auth;
use View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // return session()->all();
        $categories = Category::get();
        // return get_defined_vars();



        $sub_cat = [];
        $subsub_cat = [];
        $product = Product::with('getcategory');
        $product = $product->orderBy('name', 'DESC')->get();

        $categories = Category::get();
        $category = Category::where('id', request()->category)->get();
        $trademarks = Trademark::all();
        $origins = Origin::all();
        return view('frontend.index', get_defined_vars());
    }
    public function showproduct(Request $request)
    {
        $product = Product::all();
        $product = Product::where('name', 'LIKE', '%' . $request->searchbar . '%')->get();
        $search = $request->searchbar;


        $categories = Category::get();
        return view('frontend.search', get_defined_vars());
    }
    public function display_product(Request $request)
    {

        // return $request;

        if ($request->ajax()) {
            $product = Product::where('id', $request->id)->with('image')->first();
            $next = Product::where('items_status', $request->type, "AND")->where('id', '>', $product->id)->min('id');
            $pre = Product::where('items_status', $request->type, "AND")->where('id', '<', $product->id)->max('id');
            $data = [];
            $data['product'] = $product;
            $data['pre'] = $pre;
            $data['next'] = $next;
            return $data;
        }

        $categories = Category::get();
        return view('frontend.index', get_defined_vars());
    }

    public function set_post_code_session(Request $request)
    {
        session_start();
        $request->validate([
            'postcode_1' => 'required|int',
            'postcode_2' => 'required|int',
            'postcode_3' => 'required|int',
            'postcode_4' => 'required|int',
            'postcode_5' => 'required|int',

        ]);
        $postcode = $request->postcode_1 . $request->postcode_2 . $request->postcode_3 . $request->postcode_4 . $request->postcode_5;

        $check = Postcode::where('postcode', $postcode)->first();

        if ($check) {
            $_SESSION['postcode'] = $postcode;
            unset($_SESSION['delivery_datetime']);
            return 200;
        } else {
            $_SESSION['error'] = "Tyvärr kan vi inte leverera till denna adress, lämna ditt email och vi meddelar när vi kan köra ut till dig!";
            return 404;
            //  return redirect()->route('index')->with(['error'=>"Tyvärr kan vi inte leverera till denna adress, lämna ditt email och vi meddelar när vi kan köra ut till dig!"]);
        }


        return redirect()->back();
    }
    public function get_post_code_session()
    {
        session_start();
        // $_SESSION['postcode'] = 12345;
        // unset($_SESSION['delivery_datetime']);
        if (isset($_SESSION['postcode'])) {

            return response()->json($_SESSION['postcode']);
        }

        return response()->json([]);
    }

    public function get_user_postcode_session($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if ($user) {
            $_SESSION['postcode'] = $user->postal_code;
            return response()->json($user->postal_code);
        }
        return response()->json([]);
    }
}
