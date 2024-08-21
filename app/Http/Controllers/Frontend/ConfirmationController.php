<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\DeliveryAddress;
use App\Models\DeliveryTime;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail;
use App\Models\CouponUser;

class ConfirmationController extends Controller
{
    public function index(Request $request)
    {

        if (session_status() === PHP_SESSION_NONE) session_start();

        $categories = Category::get();
        // dd($request->order_id);
        $response = Http::withHeaders(['Authorization' => env("KLARNA_KEY"), "Content-Type" => "application/json"])->get(env("KLARNA_ENVIRONMENT") . 'checkout/v3/orders/' . $request->order_id);
        $klarna_order_confirmation = json_decode($response->body());
        $clear_cart = false;
        $error = [];
        $order = Orders::where('id', $klarna_order_confirmation->order_id)->first();
        if (!$order) {
            // $delivery = new DeliveryAddress();
            // $delivery->fname = $klarna_order_confirmation->shipping_address->given_name;
            // $delivery->lname = $klarna_order_confirmation->shipping_address->family_name;
            // $delivery->email = $klarna_order_confirmation->shipping_address->email;
            // $delivery->street_address = $klarna_order_confirmation->shipping_address->street_address;
            // $delivery->postal_code = $klarna_order_confirmation->shipping_address->postal_code;
            // $delivery->city = $klarna_order_confirmation->shipping_address->city;
            // $delivery->phone = $klarna_order_confirmation->shipping_address->phone;
            // $delivery->country = $klarna_order_confirmation->shipping_address->country;
            // $delivery->save();



            $deliverytimesession = $_SESSION['delivery_datetime'];
            $deliverytime = DeliveryTime::where('date', $deliverytimesession['delivery_date'])
                ->where('start_time', $deliverytimesession['start_time'])
                ->where('end_time', $deliverytimesession['end_time'])->first();
            if ($deliverytime) {
                if ($deliverytime->no_of_orders >= 4) {
                    $deliverytime->status = 0;
                }
                $deliverytime->no_of_orders = $deliverytime->no_of_orders + 1;
                $deliverytime->save();
            } else {

                $deliverytime = new DeliveryTime();
                $deliverytime->start_time = $deliverytimesession['start_time'];
                $deliverytime->end_time = $deliverytimesession['end_time'];
                $deliverytime->date = $deliverytimesession['delivery_date'];
                $deliverytime->status = 1;
                $deliverytime->no_of_orders = 1;
                $deliverytime->save();
            }
            unset($_SESSION['delivery_datetime']);

            $order = new Orders();
            $order->id = $klarna_order_confirmation->order_id;
            $order->user_id = (auth()->user()) ? auth()->user()->id : null;


            if (isset($_SESSION['recurring_delivery'])) {
                $order->recurring_delivery = $_SESSION['recurring_delivery'];
                unset($_SESSION['recurring_delivery']);
            }
            if (isset($_SESSION['message'])) {
                $order->message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['leave_outside'])) {
                $order->leave_outside = $_SESSION['leave_outside'];
                unset($_SESSION['leave_outside']);
            }
            if (isset($_SESSION['delivery_address'])) {
                $delivery = DeliveryAddress::where('id', $_SESSION['delivery_address'])->first();
                $delivery->email = $klarna_order_confirmation->shipping_address->email;
                $delivery->save();
            }

            $order->status = 0;
            $order->delivery_address_id = $_SESSION['delivery_address'];
            $order->delivery_time_id = $deliverytime->id;
            $order->total_price = $klarna_order_confirmation->order_amount / 100;
            $order->save();
            if (isset($_SESSION['coupon_id'])) {
                $couponuser = new CouponUser();
                $couponuser->user_id = auth()->user()->id;
                $couponuser->coupon_id = $_SESSION['coupon_id'];
                $couponuser->order_id = $order->id;
                $couponuser->save();
                unset($_SESSION['coupon_id']);
                unset($_SESSION['coupon_code']);
            }
            foreach ($_SESSION['cart'] as $product_id => $qty) {

                $order_details = new OrderDetail();
                $order_details->order_id = $klarna_order_confirmation->order_id;
                $order_details->product_id  = $product_id;
                $order_details->qty = $qty;
                $order_details->save();
            };

            try {
                if (auth()->check()) {
                    Mail::to(auth()->user()->email)->send(new ConfirmationEmail($order->id));
                } else {
                    Mail::to($order->getdeliveryaddress->email)->send(new ConfirmationEmail($order->id));
                }
                Mail::to(env("MAIL_BCC_ADDRESS"))->send(new ConfirmationEmail($order->id, true));
            } catch (\Exception $e) {
            }


            $clear_cart = true;
        }

        unset($_SESSION['cart']);
        return view('frontend.confirmation', ['klarna_order_confirmation' => $klarna_order_confirmation, 'categories' => $categories, 'clear_cart' => $clear_cart, 'error' => $error]);
    }

    public function businessOrderConfirmation(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $categories = Category::get();

        $clear_cart = false;
        $error = [];
        $orderID = uniqid();
        $maxId = Orders::max('custom_order_id');
        if ($maxId) {
            $customId = "LH" . str_pad(substr($maxId, 2) + 1, 6, "0", STR_PAD_LEFT);
        } else {
            $customId = "LH" . str_pad(1000, 6, "0", STR_PAD_LEFT);
        }

        $cartData = json_decode($request['cart']);

        if (!empty($cartData)) {


            $details = [];
            $total = 0;
            foreach ($cartData as $cart) {

                if (!empty($cart->products)) {

                    foreach ($cart->products as $product) {
                        $details[] = [
                            'product_id' => $product->item_id,
                            'order_id' => $orderID,
                            'qty' => $product->quantity
                        ];

                        $total += ($product->quantity * format_price(!empty($product->item_sale_price) ? $product->item_sale_price : $product->item_price));
                        $total += $product->pant > 0 ? format_price($product->pant) : 0;
                    }
                }
            }
            $total += (auth()->user()->customer_type == 1) ? 0 : 95;


            $deliverytimesession = json_decode($request['delivery_datetime']);
            $deliverytime = DeliveryTime::where('date', $deliverytimesession->delivery_date)
                ->where('start_time', $deliverytimesession->start_time)
                ->where('end_time', $deliverytimesession->end_time)->first();

            if ($deliverytime) {
                if ($deliverytime->no_of_orders >= 4) {
                    $deliverytime->status = 0;
                }
                $deliverytime->no_of_orders = $deliverytime->no_of_orders + 1;
                $deliverytime->save();
            } else {

                $deliverytime = new DeliveryTime();
                $deliverytime->start_time = $deliverytimesession->start_time;
                $deliverytime->end_time = $deliverytimesession->end_time;
                $deliverytime->date = $deliverytimesession->delivery_date;
                $deliverytime->status = 1;
                $deliverytime->no_of_orders = 1;
                $deliverytime->save();
            }

            $order = new Orders();
            $order->id = $orderID;
            $order->custom_order_id = $customId;
            $order->user_id = (auth()->user()) ? auth()->user()->id : null;


            if (isset($_SESSION['recurring_delivery'])) {
                $order->recurring_delivery = $_SESSION['recurring_delivery'];
                unset($_SESSION['recurring_delivery']);
            }
            if (isset($_SESSION['message'])) {
                $order->message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['leave_outside'])) {
                $order->leave_outside = $_SESSION['leave_outside'];
                unset($_SESSION['leave_outside']);
            }
            if (isset($request['delivery_address'])) {
                $delivery = DeliveryAddress::where('id', $request['delivery_address'])->first();
                $delivery->name_of_recipient = $request['name_of_recipient'] ?? null;
                $delivery->update();
            }

            $order->status = 0;
            $order->delivery_address_id = $request['delivery_address'] ?? null;
            $order->delivery_time_id = $deliverytime->id;
            $order->billing_address_id = $request['billing_address'] ?? null;
            $order->total_price =  $total;
            $order->save();

            $order->getorder()->createMany($details);

            try {
                if (auth()->check()) {
                    Mail::to(auth()->user()->email)->send(new ConfirmationEmail($order->id));
                } else {
                    Mail::to($order->getdeliveryaddress->email)->send(new ConfirmationEmail($order->id));
                }
                if (env("MAIL_BCC_ADDRESS")) {
                    Mail::to(env("MAIL_BCC_ADDRESS"))->send(new ConfirmationEmail($order->id, true));
                }
            } catch (\Exception $e) {
            }

            $clear_cart = true;
        }

        unset($_SESSION['cart']);

        return response(200);
    }

    // public function emailtest()
    // {
    //     $sendtoadmin = env('MAIL_FROM_ADDRESS');
    //     // $orders = Orders::where('custom_order_id','LH059403')->first();
    //     $orders = Orders::where('custom_order_id','LH059396')->first();
    //     return view('emails.confirmation', compact('sendtoadmin','orders'));
    //     // return view('emails.refund-order', compact('sendtoadmin','orders'));
    // }
}
