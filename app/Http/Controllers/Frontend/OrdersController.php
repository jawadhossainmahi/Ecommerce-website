<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Category;
use App\Models\Orders;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{
    public function index()
    {
        $pending_orders = Orders::where('status', 0)->where('user_id', auth()->user()->id)->where('recurring_delivery', null)->orderBy('created_at', 'DESC')->get();
        $delivered_orders = Orders::where('status', 1)->where('user_id', auth()->user()->id)->where('recurring_delivery', null)->orderBy('created_at', 'DESC')->get();
        $cancelled_orders = Orders::where('status', 2)->where('user_id', auth()->user()->id)->where('recurring_delivery', null)->orderBy('created_at', 'DESC')->get();

        $categories = Category::get();

        return view('frontend.orders', get_defined_vars());
    }

    public function recurring_delivery_show()
    {
        $recurring_orders = Orders::where('status', 2)->where('user_id', auth()->user()->id)->where('recurring_delivery', '!=', null)->get();

        return view('frontend.recurring-deliveries', get_defined_vars());
    }

    public function details(Request $request)
    {
        $order = Orders::where('id', $request->order_id)->first();
        list($discount_without_coupons, $total, $total_discount, $tax, $totalTaxAmt12, $totalTaxAmt25) = order_details($order);
        $categories = Category::get();

        return view('frontend.order-details', get_defined_vars());
    }
    public function recurring_delivery(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['recurring_delivery'] = $request->cycle;
        $response = Http::withHeaders(['Authorization' => env("KLARNA_KEY"), "Content-Type" => "application/json"])->post(env("KLARNA_ENVIRONMENT") . 'checkout/v3/orders/' . $request->order_id);
        $klarna_order_confirmation = json_decode($response->body());
    }
    public function remove_recurring_delivery()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['recurring_delivery'])) {

            unset($_SESSION['recurring_delivery']);
        }
    }

    public function message(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['message'] = $request->message;
    }
    public function remove_message()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
        }
    }

    public function leave_outside()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['leave_outside'] = true;
    }
    public function remove_leave_outside()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['leave_outside'])) {
            unset($_SESSION['leave_outside']);
        }
    }


    public function coupon(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $date = date("Y-m-d");
        $coupon_code = $request->code;
        $user_id = $request->mainId;

        if ($user_id) {

            if (!$coupon_code) {

                $this->remove_coupon();
                return 400;
            }


            $coupon = Coupon::where('code', $coupon_code)->where('coupons.start_date', '<=', $date)
                ->where('coupons.end_date', '>=', $date)->first();

            if ($coupon) {
                $user_coupon = Coupon::join('coupon_users', 'coupons.id', '=', 'coupon_users.coupon_id')
                    ->join('users', 'users.id', '=', 'coupon_users.user_id')
                    ->where('coupons.code', $coupon_code)
                    ->where('users.id', $user_id)

                    ->selectRaw('COUNT(*) as count')
                    ->addSelect('coupons.usage_limit')
                    ->addSelect('coupons.amount')
                    ->addSelect('coupons.id')
                    ->groupBy('coupons.usage_limit')
                    ->groupBy('coupons.amount')
                    ->groupBy('coupons.id')
                    ->first();
                if (!$user_coupon) {
                    $_SESSION['coupon_code'] = $coupon_code;
                    $_SESSION['coupon_id'] = $coupon->id;
                    return $coupon;
                }
                if (($user_coupon->usage_limit > $user_coupon->count) && ($user_coupon->amount < $request->total)) {
                    $_SESSION['coupon_code'] = $coupon_code;
                    $_SESSION['coupon_id'] = $coupon->id;
                    return $coupon;
                }
            }
        }
        $this->remove_coupon();
        return 404;
    }
    public function remove_coupon()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['coupon_code'])) {
            unset($_SESSION['coupon_code']);
            unset($_SESSION['coupon_id']);
        }
    }

    public function edit($order_id){
        $order = Orders::where('id',$order_id)->first();
        list($discount_without_coupons, $total, $total_discount, $tax, $totalTaxAmt12, $totalTaxAmt25) = order_details($order);
        $categories = Category::get();
        return view("frontend.edit_order",get_defined_vars());
    }
}
