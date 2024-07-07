<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Category;
use App\Models\UserBilling;
use App\Models\UserDelivery;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $user = User::where('id', auth()->user()->id)->first();
        $delivery_addresses = $user->delivery_address;

        // $delivery_addresses = DeliveryAddress::where('id',auth()->user()->id)->get();
        return view('frontend.profile', get_defined_vars());
    }

    public function edit_address(Request $request)
    {
        $delivery_address = DeliveryAddress::where('id', $request->id)->first();
        if ($delivery_address) {
            // $delivery_address->user_id = auth()->user()->id;
            $delivery_address->fname = $request->fname;
            $delivery_address->lname = $request->lname;
            $delivery_address->email = auth()->user()->email;
            $delivery_address->street_address = $request->street_address;
            $delivery_address->postal_code = $request->zip_code;
            $delivery_address->phone = $request->mobile_number;
            $delivery_address->city = $request->city;
            $delivery_address->organization = $request->organization??null;
            $delivery_address->invoice_email = $request->invoice_email??null;
            $delivery_address->save();
        }
        return redirect()->back();
    }

    public function add_address(Request $request)
    {

        $delivery_address = new DeliveryAddress();
        // $delivery_address->user_id = auth()->user()->id;
        $delivery_address->fname = $request->fname;
        $delivery_address->lname = $request->lname;
        $delivery_address->email = auth()->user()->email;
        $delivery_address->street_address = $request->street_address;
        $delivery_address->postal_code = $request->zip_code;
        $delivery_address->phone = $request->mobile_number;
        $delivery_address->city = $request->city;
        $delivery_address->save();
        $user_delivery = new UserDelivery();
        $user_delivery->user_id = auth()->user()->id;
        $user_delivery->delivery_address_id = $delivery_address->id;
        $user_delivery->save();
        return redirect()->back();
    }
    public function add_billing_address(Request $request)
    {

        $delivery_address = new DeliveryAddress();
        // $delivery_address->user_id = auth()->user()->id;
        $delivery_address->fname = $request->fname;
        $delivery_address->lname = $request->lname;
        $delivery_address->email = auth()->user()->email;
        $delivery_address->street_address = $request->street_address;
        $delivery_address->postal_code = $request->zip_code;
        $delivery_address->phone = $request->mobile_number;
        $delivery_address->city = $request->city;
        $delivery_address->organization = $request->organization??null;
        $delivery_address->invoice_email = $request->invoice_email??null;
        $delivery_address->save();
        $user_billing = new UserBilling();
        $user_billing->user_id = auth()->user()->id;
        $user_billing->delivery_address_id = $delivery_address->id;
        $user_billing->active = '1';
        $user_billing->save();
        return redirect()->back();
    }
}
