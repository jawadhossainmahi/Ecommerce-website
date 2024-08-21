<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

if (!function_exists("api_data_format")) {
    function api_data_format($products, $id = 0)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $data = [];
        foreach ($products as $product) {
            $image = env("BASE_URL") . "frontend/images/no-item.png";
            if ($product->images->isNotEmpty()) {
                $image = env("BASE_URL") . "" . $product->images[0]->path;
            };
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
                // dd(!empty($product->getsubsubcategory->toArray()));
                $getsubsubcategory_id = $product->getsubsubcategory[0]->id;
                $getsubsubcategory = $product->getsubsubcategory[0]->name;
            }
            $is_favourite = false;
            if ($id) {
                $user = User::where('id', $id)->first();
                $is_favourite = $user->is_favourite($product->id);
            }
            $item_qty  = 0;
            if (isset($_SESSION['cart'])) {
                if (array_key_exists($product->id, $_SESSION['cart'])) {
                    $item_qty = $_SESSION['cart'][$product->id];
                }
            }

            // $origin = null;
            // if($product->origin_id){
            //     $origin = ProductOrigin::where('id', $product->origin_id)->first();
            // }

            if (!strlen(htmlspecialchars($product->product_information, ENT_QUOTES, 'UTF-8'))) {
                $product->product_information = null;
            }
            if (!strlen(htmlspecialchars($product->ingredients, ENT_QUOTES, 'UTF-8'))) {
                $product->ingredients = null;
            }
            if (!strlen(htmlspecialchars($product->storage, ENT_QUOTES, 'UTF-8'))) {
                $product->storage = null;
            }
            if (!strlen(htmlspecialchars($product->other_information, ENT_QUOTES, 'UTF-8'))) {
                $product->other_information = null;
            }
            if (!strlen(htmlspecialchars($product->nutritional_content, ENT_QUOTES, 'UTF-8'))) {
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
                'buy_two_for' => $product->buy_two_get,
                'price' => $product->price,
                'price_per_item' => $product->price_per_item,
                'compare_price' => $product->compare_price,
                'pant' => $product->pant ?? null,
                'status' => $product->status,
                'weight' => $product->weight,
                'item_status' => $product->item_status,
                'tax' => $product->tax,
                'discount_price' => $product->discount_price,

            ];
            array_push($data, $item);
            // $data[$product->id] = $item;
        }
        return $data;
    }
}
if (!function_exists("display_price_format")) {
    function display_price_format($price)
    {
        return "SEK " . preg_replace('/\./', ',', number_format($price, 2));
    }
}


if (!function_exists("format_price")) {
    function format_price($price)
    {
        if ($price) {
            return floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $price)));
        }
        return 0;
    }
}

if (!function_exists("calc_discount_price")) {
    function calc_discount_price($discount_price, $original_price, $qty)
    {
        return (floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $discount_price))) / 2 * ($qty - $qty % 2)) + floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $original_price)) * ($qty % 2));
    }
}

if (!function_exists("format_subtotal_price")) {
    function format_subtotal_price($price)
    {
        return preg_replace('/[.]/', ',', number_format(floatval(preg_replace('/[^0-9.]+/', '', preg_replace('/[,:]/', '.', $price))), 2));
    }
}

if (!function_exists("order_details")) {
    function order_details($order)
    {

        $total = 0;
        $total_price_without_discount = 0;
        $totalTaxAmt12 = 0;
        $totalTaxAmt25 = 0;

        foreach ($order->getorder as $item) {

            $product = $item->getproduct;
            $price = $item->getproduct->price;
            $quantity = $item->qty;
            $total_price_without_discount += format_price($price) * $quantity + format_price($product->pant);
            if ($product->discount_price > 0) {
                $discount_price = format_price($product->discount_price);

                if ($product->buy_two_get) {
                    if ($quantity > 0) {
                        // $total = $total + calc_discount_price($discount_price, $price, $quantity) + format_price($product->pant) * format_price($quantity);
                        $total = $total + calc_discount_price($discount_price, $price, $quantity);
                    } else {
                        // $total = $total + format_price($discount_price) * $quantity + format_price($product->pant) * format_price($quantity);
                        $total = $total + format_price($discount_price) * $quantity;
                    }
                } else {
                }
            } else {
                // $total = $total + format_price($price) * $quantity + format_price($product->pant) * format_price($quantity);
                $total = $total + format_price($price) * $quantity;
            }

            $discount_without_coupons = $total_price_without_discount - $total;
            $tax = 95;
            $total_discount = 0;
            if (!$order->coupon->isEmpty()) {
                if ($order->coupon[0]->type == 'Percentage') {
                    $discount = ($total * $order->coupon[0]->amount) / 100;
                    if ($order->coupon[0]->max_discount != null && $discount > $order->coupon[0]->max_discount) {
                        $total = $total - $order->coupon[0]->max_discount;
                        $total_discount += $order->coupon[0]->max_discount;
                    } else {
                        $total = $total - $discount;
                        $total_discount += $discount;
                    }
                } elseif ($order->coupon[0]->type == 'Flat') {
                    if ($total - $order->coupon[0]->amount > 0) {
                        $total = $total - $order->coupon[0]->amount;
                        $total_discount += $order->coupon[0]->amount;
                    } else {
                    }
                } elseif ($order->coupon[0]->type == 'FreeShipping') {
                    $tax = 0;
                }
            }

            //Tax Calculation
            if ($product->tax == 25) {
                $totalTaxAmt25 += (format_price($product->discount_price > 0 ? $product->discount_price : $product->price)) * $quantity;
            }
            if ($product->tax == 12) {
                $totalTaxAmt12 += (format_price($product->discount_price > 0 ? $product->discount_price : $product->price) + format_price($product->pant)) * $quantity;
            }
        }

        //Add Shipment Cost Tax
        if (($order->total_price - 95) < 650) {
            $totalTaxAmt12 += (($order->getuser->customer_type == 1) ? 0 : 95);
        }

        $totalTaxAmt12 = $totalTaxAmt12 - ($totalTaxAmt12 / 1.12);
        $totalTaxAmt25 = $totalTaxAmt25 - ($totalTaxAmt25 / 1.25);

        return [$discount_without_coupons ?? 0, $total ?? 0, $total_discount ?? 0, $tax ?? 0, $totalTaxAmt12 ?? 0, $totalTaxAmt25 ?? 0];
    }
}

if (!function_exists("filterStringToArray")) {
    function filterStringToArray($data = "")
    {
        $title = preg_replace('![\s]+!u', '-', trim($data));
        $title = preg_replace('![^-\pL\pN\s]+!u', '-', $title);
        $title = preg_replace('![-\s]+!u', '-', $title);
        $res = explode('-', $title);

        if (count($res) == 2) {
            $space = str_replace('-', ' ', $title);
            $rev = implode(" ", array_reverse($res));
            return array_unique([$data, $title, $space, $rev]);
        } else if (count($res) > 2) {

            $space = str_replace('-', ' ', $title);
            $rev = implode(" ", array_reverse($res));
            $new = $res[0] . "-" . $res[1] . " " . $res[2];
            return array_unique([$data, $title, $space, $rev, $new]);
        }
        return array_unique([$data, $title]);
    }
}

if (!function_exists("popularProductPoint")) {
    function popularProductPoint($product_id = false, $type = "open")
    {
        if ($product_id) {
            $point = match ($type) {
                'open' => 1,
                'cart' => 2,
                'purchase' => 3,
                default => 0
            };
            Product::find($product_id)?->increment('popularity', $point);
            // DB::table('products')->where('id', $product_id)->first()->increment('popularity');
        }
    }
}
