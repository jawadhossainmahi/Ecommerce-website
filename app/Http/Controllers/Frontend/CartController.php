<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Redirect;
use App\Models\Cart;
// use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {

        $cart = Cart::where('user_id', Auth::user()->id)->with('getproduct')->get();



        // return Redirect::to(url()->previous());
        return view('frontend.master', get_defined_vars());
    }
    public function store(Request $request, Cart $cart, $id)
    {
        // return $id;

        $user_id = Auth::user()->id;
        $check_cart = Cart::where('product_id', $id, 'AND')->where('user_id', $user_id)->first();
        if ($check_cart) {
            if ($check_cart->qty >=  10) {
                return redirect()->back()->with('message', "ProductLimit Exceed!");
            }
            $check_cart->qty = $check_cart->qty + 1;
            $check_cart->save();
            return redirect()->back()->with('message', "Cart Quantity Has Been Increased Successfully!");
        }
        $request->request->add(['user_id' => $user_id]);
        $request->request->add(['product_id' => $id]);


        $request->validate([
            // 'name'        =>'required',
        ]);
        $cart = $cart->create($request->all());
        return redirect()->back()->with('message', "Product Has Been Added Successfully!");
    }

    public function update(Request $request)
    {
        //   $request;
        $id = $request->input('id');
        $qty = $request->input('qty');
        //$price = $request->input('price');

        foreach ($id as $key => $value) {

            Cart::where('id', $value, 'AND')->where('user_id', Auth::user()->id)->update(['qty' => $qty[$key]]);
        }
        return redirect()->back()->with('message', "Product list Has Been Saved Successfully!");
    }
    public function delete(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('index')->with('warning', "Product Has Been Deleted Successfully!");
    }
    public function delete_all()
    {

        Cart::query()->where('user_id', auth()->user()->id)->delete();

        return redirect()->route('index')->with('warning', "All Products Has Been Deleted Successfully!");
    }
}
