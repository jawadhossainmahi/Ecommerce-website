<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Models\User;
use App\Models\UserBilling;
use App\Models\UserDelivery;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Http\Controllers\Controller;

class BillingAddressController extends Controller
{
   

    public function get_address(Request $request)
    {
        $user_billing = UserBilling::where('user_id', $request->main_id)->where('delivery_address_id', $request->id)->first();
        if ($user_billing) {
            $reset = UserBilling::with('user')->where('user_id', $request->main_id)->update(['active' => '0']);
            $user_billing->active = 1;
            $user_billing->save();
            $_SESSION['billing_address'] = $user_billing->delivery_address_id;
            $billing_address = DeliveryAddress::with('billingUser')->where('id', $request->id)->first();
            return response()->json($billing_address);
        }
        return response()->json(404);
    }

    public function get_default_address(Request $request)
    {

        $user_billing = UserBilling::where('user_id', $request->main_id)->where('active', '1')->first();

        if ($user_billing) {
            $billing_address = DeliveryAddress::with('billingUser')->where('id', $user_billing->delivery_address_id)->first();
            $_SESSION['billing_address'] = $user_billing->delivery_address_id;
            return response()->json($billing_address);
        }
        return response()->json(404);
    }
    public function store(Request $request)
    {

        if (session_status() === PHP_SESSION_NONE) session_start();

        $user_billing = UserBilling::where('delivery_address_id', $request->id)->where('user_id', $request->main_id)->first();
        if ($user_billing) {
            $reset = UserBilling::where('user_id', $request->main_id)->update(['active' => '0']);

            $user_billing = UserBilling::where('delivery_address_id', $request->id)->where('user_id', $request->main_id)->first();
            $user_billing->active = 1;
            $user_billing->save();
            $_SESSION['billing_address'] = $user_billing->delivery_address_id;
            $billing_address = DeliveryAddress::with('billingUser')->where('id', $request->id)->first();
            return response()->json($billing_address);
        }
        return response()->json(404);
    }

    public function same_billing_address(Request $request)
    {

        $user_delivery = UserDelivery::where('delivery_address_id', $request->deliveryId)->where('user_id', $request->userId)->first();
        if ($request->isSave && $user_delivery) {

            $billing = new UserBilling();
            $billing->user_id = $user_delivery->user_id;
            $billing->delivery_address_id = $user_delivery->delivery_address_id;
            $billing->active = 1;
            $billing->save();

            session(['billing_address' => $user_delivery->delivery_address_id]);
            $billing_address = DeliveryAddress::with('billingUser')->where('id', $user_delivery->delivery_address_id)->first();
            return response()->json($billing_address);
        }else{
            $billing = UserBilling::where('delivery_address_id', $request->deliveryId)->delete();
            return response()->json(200);
        }
        return response()->json(404);
    }
}
