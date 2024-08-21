<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Models\Orders;
use App\Models\Product;
use App\Models\DeliveryTime;
use App\Models\ShoppingCart;
use App\Models\ShoppingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{



    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // $jsonData = file_get_contents('https://livsham.se/api/products');
        // $data = json_decode($jsonData, true);
        $products = Product::whereIn('id', array_keys($_SESSION['cart']))->get();

        $results = array();
        $product_details = array();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            $_SESSION['cart_pant'] = array();
        } else {


            // Loop through the products and organize them by category
            foreach ($products as $product) {
                $image = "frontend/images/no-item.png";
                if ($product->images->isNotEmpty()) {
                    $image = $product->images[0]->path;
                };
                // Create a product object with relevant data
                $product_details = array(
                    'buy_two' => $product->buy_two_get ?? false,
                    'category' => $product->getcategory->name,
                    'image' => $image,
                    'item_id' => $product->id,
                    'item_name' => $product->name,
                    'item_price' => $product->price,
                    'item_sale_price' => $product->discount_price ?? 0,
                    'pant' => $product->pant,
                    'quantity' => $_SESSION['cart'][$product->id] ?? 0,
                );

                // If the category is not already added to the results array, add it
                if (!isset($results[$product_details['category']])) {
                    $results[$product_details['category']] = array(
                        'category' => $product_details['category'],
                        'products' => array(),
                    );
                }

                // Add the product details to the appropriate category in the results array
                $results[$product_details['category']]['products'][] = $product_details;
            }
        }


        if (empty($results)) {
            $results = ['status' => 'error', 'message' => 'No Products in Cart'];
        }
        return array_values($results);
    }

    public function getOrderItemsToCart($order_id)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $_SESSION['cart'] = array();
        $_SESSION['cart_pant'] = array();

        $order = Orders::where('id', $order_id)->first();
        foreach ($order->getorder as $orderItem) {

            $_SESSION['cart'][$orderItem->getproduct->id] = $orderItem->qty;
            $_SESSION['cart_pant'][$orderItem->getproduct->id] = $orderItem->getproduct->pant;
        }
        return response()->json($this->index());
        // return response()->json($_SESSION['cart']);


    }

    public function getCartData(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $cartData = json_decode($request->cart);
        // return $request->cart;
        $this->insertInCart($cartData);
        // return $this->insertInCart($cartData);
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $product_ids = array_keys($_SESSION['cart']);

            try {
                // Fetch products from the database using Eloquent
                $products = Product::whereIn('id', $product_ids)->get();

                return response()->json(api_data_format($products));
            } catch (\Exception $e) {
                return response()->json(['error' => 'An error occurred while fetching cart data.']);
            }
        } else {
            return response()->json();
        }
    }

    public function getShoppingListItemsToCart(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $_SESSION['cart'] = array();
        $_SESSION['cart_pant'] = array();
        $shopping_list = ShoppingCart::where('shopping_id', $request->shopping_list_id)->get();

        foreach ($shopping_list as $shoppingItem) {

            $_SESSION['cart'][$shoppingItem->product_id] = $shoppingItem->quantity;
            $_SESSION['cart_pant'][$shoppingItem->product_id] = $shoppingItem->getproduct->pant;
        }

        return response()->json($this->index());
    }

    public function store(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $product_id = $request['id'];
        $qty = $request['qty'];
        $pant = $request['pant'];
        $array = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (isset($_SESSION['cart'][$product_id])) {
            if ($qty == 0) {
                unset($_SESSION['cart'][$product_id]);
            } else {
                $_SESSION['cart'][$product_id] = $qty;
                $_SESSION['cart_pant'][$product_id] = $pant;
            }
        }
    }

    public function insert(Request $request)
    {

        $cartData = json_decode($request->cart);
        $this->insertInCart($cartData);
    }
    public function insertBusinessOrder(Request $request)
    {
        //         cart: cart,
        //         customer_type: 'business',
        //         delivery_address: delivery_address,
        //         billing_address: billing_address,
        //         name_of_recipient: name_of_recipient,
        //         delivery_datetime: delivery_datetime,


        // Full texts
        // id
        // custom_order_id Descending 1
        // status
        // user_id
        // delivery_address_id
        // delivery_time_id
        // total_price
        // sub_total
        // sub_total_deposit
        // discount
        // discount_code
        // coupon_discount
        // transport_tax
        // recurring_delivery
        // leave_outside
        // message
        // created_at
        // updated_at


        try {

            $cartData = json_decode($request->cart);
            $orderID = uniqid();

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

                        $total += ($product->quantity * $product->item_price);
                    }
                }
            }

            $dTime = $request->delivery_datetime;

            $deliveryTime = new DeliveryTime();
            $deliveryTime->date =  $dTime->delivery_date;
            $deliveryTime->start_time =  $dTime->start_time;
            $deliveryTime->end_time =  $dTime->end_time;
            $deliveryTime->no_of_orders = 1;

            $order = new Orders();
            $order->custom_order_id = $orderID;
            $order->status = 1;
            $order->user_id = auth()->user()->id;
            $order->delivery_address_id = $request->delivery_address;
            $order->delivery_time_id = $deliveryTime->id;
            $order->billing_address_id = $request->billing_address;
            $order->total_price =  $total;
            $order->save();


            $order->getorder()->createMany($details);

            return response(200);
        } catch (\Exception $e) {
            return response(500);
        }
    }

    public function insertInCart($cartData)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (!isset($_SESSION['cart_pant'])) {
            $_SESSION['cart_pant'] = array();
        }
        foreach ($cartData as $cartitems) {
            foreach ($cartitems->products as $cartitem) {
                $_SESSION['cart'][$cartitem->item_id] = $cartitem->quantity;
                $_SESSION['cart_pant'][$cartitem->item_id] = $cartitem->pant;
            }
        }
    }

    public function destroy()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        unset($_SESSION['cart']);
        unset($_SESSION['cart_pant']);
    }

    public function GetQuantity(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id = $request['id'];
        $array = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (isset($_SESSION['cart'][$id])) {
            $qty = intval($_SESSION['cart'][$id]) + 1;
            $_SESSION['cart'][$id] = $qty;
            array_push($array, $qty);
        } else {
            $_SESSION['cart'][$id] = 1;
            array_push($array, 1);
        }
        return response()->json($array);
    }


    public function GetSession()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $array = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (!isset($_SESSION['cart_pant'])) {
            $_SESSION['cart_pant'] = array();
        }
        foreach ($_SESSION['cart'] as $key => $value) {
            $new_array = array();
            array_push($new_array, $key);
            array_push($new_array, $value);
            array_push($new_array, $_SESSION['cart_pant'][$key]);
            array_push($array, $new_array);
        }
        return response()->json($array);
    }

    public function GetTotal()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $total = 0;
        // dd($_SESSION['cart']);
        foreach ($_SESSION['cart'] as $cartitem) {

            if ($cartitem['discount_price'] <= 0) {
                $total = $total + $cartitem['qty'] * preg_replace('/[^0-9.]+/', '', str_replace(":", ".", $cartitem['price']));
            } else {
                $total = $total + $cartitem['qty'] * preg_replace('/[^0-9.]+/', '', str_replace(":", ".", $cartitem['price']));
            }
        }
        return response()->json($_SESSION);
    }
}
