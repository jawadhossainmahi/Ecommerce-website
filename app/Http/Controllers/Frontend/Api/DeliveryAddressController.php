<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDelivery;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;

class DeliveryAddressController extends Controller
{
    public function index(Request $request)
    {

        if (session_status() === PHP_SESSION_NONE) session_start();

        $user_delivery = UserDelivery::where('delivery_address_id', $request->id)->where('user_id', $request->main_id)->first();
        if ($user_delivery) {
            $reset = UserDelivery::where('user_id', $request->main_id)->update(['active' => '0']);
            $user_delivery->active = 1;
            $user_delivery->save();
            $_SESSION['delivery_address'] = $user_delivery->delivery_address_id;
            $delivery_address = DeliveryAddress::with('user')->where('id', $request->id)->first();
            return response()->json($delivery_address);
        }
        return response()->json(404);
    }

    public function get_address(Request $request)
    {



        $user_delivery = UserDelivery::where('user_id', $request->main_id)->where('delivery_address_id', $request->id)->first();
        if ($user_delivery) {
            $reset = UserDelivery::with('user')->where('user_id', $request->main_id)->update(['active' => '0']);
            $user_delivery->active = 1;
            $user_delivery->save();
            $_SESSION['delivery_address'] = $user_delivery->delivery_address_id;
            $delivery_address = DeliveryAddress::where('id', $request->id)->first();
            return response()->json($delivery_address);
        }
        return response()->json(404);
    }

    public function get_default_address(Request $request)
    {

        $user_delivery = UserDelivery::where('user_id', $request->main_id)->where('active', '1')->first();

        if ($user_delivery) {
            $delivery_address = DeliveryAddress::with('user')->where('id', $user_delivery->id)->first();
            $_SESSION['delivery_address'] = $user_delivery->delivery_address_id;
            return response()->json($delivery_address);
        }
        return response()->json(404);
    }
}
