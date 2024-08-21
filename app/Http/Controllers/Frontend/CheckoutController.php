<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Orders;
use App\Mail\OrderMail;
use App\Models\Coupon;

use App\Models\DeliveryAddress;
use App\Models\UserDelivery;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        // return auth()->user();
        $user = User::where('id', auth()->user()->id)->first();
        $delivery_addresses = $user->delivery_address;
        $billing_addresses = $user->billing_address;
        return view('frontend.checkout', get_defined_vars());
    }

    public function calc_discount_price($discount_price, $original_price, $qty)
    {
        return (floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $discount_price))) / 2 * ($qty - $qty % 2)) + floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $original_price)) * ($qty % 2));
    }

    public function format_price($price)
    {
        if ($price) {
            return floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $price)));
        }
        return 0;
    }

    public function klarna_payment()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_SESSION['delivery_address'])) {
            $delivery_address_id = $_SESSION['delivery_address'];
            $delivery_address = DeliveryAddress::where('id', $delivery_address_id)->first();
            // dd($delivery_address);
        }


        if (isset($_SESSION['cart'])) {


            if (count($_SESSION['cart']) <= 0) {
                return redirect()->route('index')->with('error', 'Please enter items in cart before proceeding to checkout');
            }
        } else {
            return redirect()->route('index')->with('error', 'Please enter items in cart before proceeding to checkout');
        }
        if (isset($_SESSION['postcode'])) {
            if (strlen($_SESSION['postcode']) <= 0) {
                return redirect()->route('index')->with('error', 'Please enter postcode before proceeding to checkout');
            }
        } else {
            return redirect()->route('index')->with('error', 'Please enter postcode before proceeding to checkout');
        }
        $coupon_discount = 0;
        if (isset($_SESSION['coupon_id'])) {
            $coupon_id = $_SESSION['coupon_id'];
        }

        $products = Product::whereIn('id', array_keys($_SESSION['cart']))->get();

        $total = 0;
        $totals = [];
        foreach ($products as $product) {
            // dd($product->id);
            $total_per_item = [];
            $quantity = $_SESSION['cart'][$product->id];
            $price = ($this->format_price($product->price));
            $total_per_item["name"] = $product->name;
            $total_per_item["qty"] = $quantity;
            $total_per_item["discount"] = $product->discount_price;
            $total_per_item["price"] = $product->price;

            $total_per_item['pant'] = $product->pant;
            if ($product->discount_price > 0) {

                $discount_price = ($this->format_price($product->discount_price));

                if ($product->buy_two_get) {
                    if ($quantity > 0) {
                        $total = $total + $this->calc_discount_price($discount_price, $price, $quantity) + $this->format_price($product->pant) * $this->format_price($quantity);
                        $total_per_item['total'] = $this->calc_discount_price($discount_price, $price, $quantity) + $this->format_price($product->pant) * $this->format_price($quantity);
                    } else {
                        $total = $total + $this->format_price($discount_price) * $quantity + $this->format_price($product->pant) * $this->format_price($quantity);
                        $total_per_item['total'] = $this->format_price($discount_price) * $quantity + $this->format_price($product->pant) * $this->format_price($quantity);
                    }
                } else {
                    $total = $total + $this->format_price($discount_price) * $quantity + $this->format_price($product->pant) * $this->format_price($quantity);
                    $total_per_item['total'] = $this->format_price($discount_price) * $quantity + $this->format_price($product->pant) * $this->format_price($quantity);
                }
            } else {
                $total = $total + $this->format_price($price) * $quantity + $this->format_price($product->pant) * $this->format_price($quantity);
                $total_per_item['total'] = $this->format_price($price) * $quantity + $this->format_price($product->pant) * $this->format_price($quantity);
            }
            array_push($totals, $total_per_item);
        }

        $tax = 95;
        if ($total >= 650) {
            $tax = 0;
        }
        // dd("Before Coupon: Total = $total");

        if (isset($_SESSION['coupon_id'])) {
            $coupon = Coupon::where('id', $_SESSION['coupon_id'])->first();
            if ($coupon) {
                if ($coupon->type == "Percentage") {
                    $discount = ($total * $coupon->amount) / 100;
                    if (($coupon->max_discount != null) && ($discount > $coupon->max_discount)) {
                        $total = $total - $coupon->max_discount;
                    } else {
                        $total = $total - $discount;
                    }
                } else if ($coupon->type == "Flat") {

                    if (($total - $coupon->amount) > 0) {
                        $total = $total - $coupon->amount;
                    } else {
                    }
                } else if ($coupon->type == "FreeShipping") {
                    $tax = 0;
                }
            }
        }

        $total = ($total + $tax) * 100;
        // dd("After Coupon: Total = $total");
        // dd($total, $totals);

        if (isset($_SESSION['coupon_id'])) {
            unset($_SESSION['coupon_code']);
            unset($_SESSION['coupon_id']);
        }

        $recurring_delivery = [];
        $data = [
            "purchase_country" => "SE",
            "purchase_currency" => "SEK",
            "locale" => "sv-SE",
            "order_amount" => $total,
            "order_tax_amount" => 0,
            "order_lines" => [[
                "name" => "Livshem produkter",
                "quantity" => 1,
                "unit_price" => $total,
                "tax_rate" => 0,
                "total_amount" => $total,
                "total_discount_amount" => 0,
                "total_tax_amount" => 0,
                "image_url" => "https://www.livshem.se/frontend/images/logo.png"
            ]],
            // Production
            "merchant_urls" => [
                "terms" => env("BASE_URL") . "Integritetspolicy",
                "checkout" => env("BASE_URL") . "checkout",
                "confirmation" => env("BASE_URL") . "confirmation/{checkout.order.id}",
                "push" => env("BASE_URL") . ""
            ]
            // // Development
            // "merchant_urls" => [
            //     "terms" => "https://livsham.softwarebyte.co/Integritetspolicy",
            //     "checkout" => "https://livsham.softwarebyte.co/checkout",
            //     "confirmation" => "https://livsham.softwarebyte.co/",
            //     "push" => "https://livsham.softwarebyte.co/"
            // ]

        ];
        if (isset($_SESSION['recurring_delivery'])) {

            $count = ($_SESSION['recurring_delivery'] == 'bi_weekly') ? 2 : 4;
            $interval = "MONTH";
            $recurring_delivery = [
                "order_lines" => [[
                    "name" => "Liveshem Products",
                    "quantity" => 1,
                    "subscription" => [
                        "name" => "Recurring Delivery",
                        "interval" => $interval,
                        "interval_count" => $count
                    ],
                    "unit_price" => $total,
                    "tax_rate" => 0,
                    "total_amount" => $total,
                    "total_discount_amount" => 0,
                    "total_tax_amount" => 0
                ]],
                "recurring" => true,
            ];

            $data = array_merge($data, $recurring_delivery);
        }
        if (isset($_SESSION['delivery_address'])) {
            $delivery = DeliveryAddress::where('id', $_SESSION['delivery_address'])->first();
            //   $userdelivery = UserDelivery::where('delivery_address_id', $_SESSION['delivery_address'])->first();

            $delivery_address = [
                "billing_address" => [
                    "given_name" => $delivery->fname,
                    "family_name" => $delivery->lname,
                    "email" => $delivery->user[0]->email,
                    "street_address" => $delivery->street_address,
                    "postal_code" => $delivery->postal_code,
                    "city" => $delivery->city,
                    "phone" => $delivery->phone
                ]
            ];
            $data = array_merge($data, $delivery_address);
        };



        $response = Http::withHeaders(['Authorization' => env("KLARNA_KEY"), "Content-Type" => "application/json"])->post(env("KLARNA_ENVIRONMENT") . 'checkout/v3/orders', $data);
        $klarna_order = (object)($response->json()??[]);

        if (!isset($klarna_order->html_snippet)) {
            return back()->with('danger', "Failed to initiate payments!");
        }

        return view('frontend.klarna-payment', ['klarna_order' => $klarna_order]);
    }
    public function order_email()
    {
        $user = User::where("id", auth()->user()->id)->first();
        $list = Orders::where('user_id', auth()->user()->id)->with(['getorder' => function ($query) {
            $query->with('getproduct');
        }])->get();

        $order = [
            'title' => 'Välkommen till Livshem',
            'date' => date('d M , Y'),
            'list' => $list,
            'user' => $user,
        ];
        // return new OrderMail($order);
        Mail::to(auth()->user()->email)->send(new OrderMail($order));
        return redirect()->route('index')->with('message', "Beställningen har gjorts framgångsrikt! Kontrollera din e-post för mer information");
    }
}
