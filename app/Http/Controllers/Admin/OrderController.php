<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderList;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCancelEmail;
use App\Mail\ConfirmationEmail;
use App\Mail\OrderDeliveredEmail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = Orders::orderByDesc('created_at')->get();
        return view('backend.admin.orders.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where("role", '1')->orderByDesc('created_at')->get();
        $product = Product::orderByDesc('created_at')->get();
        return view('backend.admin.orders.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Orders $orders)
    {

        $request->validate([
            'user_id'                 => 'required',
            'product_id'          => 'required',
            'status'               => 'required',
        ]);

        $orders_id = $orders->create($request->all());
        foreach ($request->product_id as $key => $value) {
            $orderlist = new OrderList();
            $orderlist->order_id = $orders_id->id;
            $orderlist->qty = 1;
            $orderlist->product_id = $value;
            $orderlist->save();
        }


        return redirect()->route('admin.order.index')->with('message', "Data Added Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        list($discount_without_coupons, $total, $total_discount, $tax, $totalTaxAmt12, $totalTaxAmt25) = order_details($orders);
        return view('backend.admin.orders.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        // return $orders->getorder['id'];
        $user = User::where("role", '1')->orderByDesc('created_at')->get();
        $product = Product::orderByDesc('created_at')->get();
        return view('backend.admin.orders.edit', get_defined_vars());
    }

    public function cancelOrder($orderId)
    {
        // Prepare the API endpoint and request headers
        $endpoint = env("KLARNA_ENVIRONMENT") . "ordermanagement/v1/orders/{$orderId}/cancel";
        $headers = [
            'Authorization' => env("KLARNA_KEY"),
            'Content-Type' => 'application/json',
        ];

        // Make the API request to cancel the order
        $response = Http::withHeaders($headers)->post($endpoint);

        // Handle the API response
        if ($response->successful()) {
            // Order cancellation successful
            $responseData = [
                'code' => '201',
                'message' => 'Order cancellation successful.',
            ];
            return $responseData;
            // Process the response data as needed
            // ...
        } else {
            // Order cancellation failed
            $errorResponse = [
                'code' => '500',
                'message' => 'Something Went Wrong While cancelling the order.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        }
    }

    public function showCopyOrder(Orders $orders){
        list($discount_without_coupons, $total, $total_discount, $tax, $totalTaxAmt12, $totalTaxAmt25) = order_details($orders);
        return view('backend.admin.orders.copy', get_defined_vars());
    }



    public function captureOrder($orderId, $orderAmount)
    {

        // Prepare the API endpoint and request headers
        $endpoint = env("KLARNA_ENVIRONMENT") . "ordermanagement/v1/orders/{$orderId}/captures";
        $headers = [
            'Authorization' => env("KLARNA_KEY"),
            'Content-Type' => 'application/json',
            'Klarna-Idempotency-Key' => uniqid(),
        ];

        $captureData = [
            'captured_amount' => $orderAmount * 100,
        ];

        // Make the API request to capture the order
        $response = Http::withHeaders($headers)->post($endpoint, $captureData);

        // Handle the API response
        if ($response->status() === 201) {
            // Capture successful
            $responseData = [
                'code' => '201',
                'message' => 'Capture successful.',
            ];
            return $responseData;
            // Process the response data as needed
            // ...
        } elseif ($response->status() === 403) {
            // Capture not allowed
            $errorResponse = $response->json();
            $errorResponse = [
                'code' => '403',
                'message' => 'Capture not allowed.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        } elseif ($response->status() === 404) {
            // Order not found
            $errorResponse = [
                'code' => '404',
                'message' => 'Order not found.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        } else {
            // Other error occurred
            $errorResponse = [
                'code' => '404',
                'message' => 'Unknown error occurred.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        }
    }


    public function createRefund($orderId, $refundedAmount)
    {
        // Prepare the API endpoint and request headers
        $endpoint = env("KLARNA_ENVIRONMENT") . "ordermanagement/v1/orders/{$orderId}/refunds";
        $headers = [
            'Authorization' => env("KLARNA_KEY"),
            'Content-Type' => 'application/json',
            'Klarna-Idempotency-Key' => uniqid(), // Generate a unique idempotency key for each request
        ];

        $refundData = [

            'refunded_amount' => $refundedAmount * 100,
        ];

        // Make the API request to create a refund
        $response = Http::withHeaders($headers)->post($endpoint, $refundData);

        // Handle the API response
        if ($response->status() === 201) {
            // Refund created successfully
            $responseData = $response->json();
            $responseData = [
                'code' => '201',
                'message' => 'Refund created successfully.',
            ];
            return $responseData;
            // Process the response data as needed
            // ...
        } elseif ($response->status() === 403) {
            // Refund not allowed
            $errorResponse = $response->json();
            $errorResponse = [
                'code' => '403',
                'message' => 'Refund not allowed.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        } elseif ($response->status() === 404) {
            // Order not found
            $errorResponse = $response->json();
            $errorResponse = [
                'code' => '404',
                'message' => 'Order not found.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        } else {
            // Other error occurred
            $errorResponse = [
                'code' => '500',
                'message' => 'Unknown error occurred.',
            ];
            return $errorResponse;
            // Handle the error response
            // ...
        }
    }

    public function testCancelMail()
    {
        $order = Orders::find('659ae557abeaa');
        // $html = (new ConfirmationEmail($order->id, true))->render();
        $html = (new OrderCancelEmail($order))->render();
        // $html = (new OrderDeliveredEmail($order, true))->render();
        echo $html;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        $request->validate([
            'status'        => 'required',
        ]);
        if ($request->status == 1) {
            $check = $this->captureOrder($orders->id, $orders->total_price);
            if ($check['code'] == "201") {
                Mail::to($request->email)->send(new OrderDeliveredEmail($orders));
                Mail::to(env("MAIL_BCC_ADDRESS"))->send(new OrderDeliveredEmail($orders, true));
            } else {
                return redirect()->route('admin.order.index')->with('warning', $check['message']);
            }
        } else if ($request->status == 2) {
            $check = $this->cancelOrder($orders->id);
            if ($check['code'] == "201") {

                Mail::to($request->email)->send(new OrderCancelEmail($orders));
                Mail::to(env("MAIL_BCC_ADDRESS"))->send(new OrderCancelEmail($orders, true));
                $orders->getdeliverytime->status = 1;
                $orders->save();
            } else {
                return redirect()->route('admin.order.index')->with('message', $check['message']);
            }
        }
        $orders->update($request->all());
        return redirect()->route('admin.order.index')->with('message', "Data Updated Successfully!");
    }

    public function cancel($order_id)
    {
        $order = Orders::where("id", $order_id)->first();

        
        if($order->getuser->customer_type == 1) {
            $order->status = 2;
            $order->getdeliverytime->status = 1;
            $order->save();

            if($order->getuser->email){
                Mail::to($order->getuser->email)->send(new OrderCancelEmail($order));
            }
            Mail::to(env("MAIL_BCC_ADDRESS"))->send(new OrderCancelEmail($order, true));

            return response()->json("Data Updated Successfully!");
        }else{

            $check = $this->cancelOrder($order->id);
            if ($check['code'] == "201" ) {

                $order->status = 2;
                $order->getdeliverytime->status = 1;
                $order->save();

                Mail::to($order->getuser->email)->send(new OrderCancelEmail($order));
                Mail::to(env("MAIL_BCC_ADDRESS"))->send(new OrderCancelEmail($order, true));

            } else {
                return response()->json($check['message']);
                //  return redirect()->route('admin.order.index')->with('message',$check['message']);
            }

            return response()->json("Data Updated Successfully!");
        }

        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        $orders->delete();
        return redirect()->route('admin.order.index')->with('warning', "Data Deleted Successfully!");
    }
    public function deliveredorder()
    {
        $ordercomplete = Orders::where('status', '1')->orderByDesc('created_at')->get();

        return view('backend.admin.orders.completed', get_defined_vars());
    }
    public function deliveredopen()
    {
        $ordercomplete = Orders::where('status', '0')->orderByDesc('created_at')->get();

        return view('backend.admin.orders.open', get_defined_vars());
    }
    public function filterorder(Request $request)
    {
        // return response($request['totals']);
        $currentYear = now()->year;

        $query = Orders::query();

        if ($request['totalss'] == date('Y')) {
            $query->whereYear('created_at', $request['totalss'])->with('getuser', 'getdeliverytime')->orderByDesc('created_at');
        }

        if ($request['totalss'] == date('m')) {
            $month = date('m');
            $query->whereYear('created_at', $currentYear)->with('getuser', 'getdeliverytime')->latest()->orderByDesc('created_at');
        }

        if ($request['totalss'] == date('d')) {
            $day = date('d');
            $query->whereYear('created_at', $currentYear)->with('getuser', 'getdeliverytime')->latest()->orderByDesc('created_at');
        }

        $newCustomers = $query->get();

        return response($newCustomers);
    }
    public function total()
    {
        $orders = Orders::with('getorder', 'coupon', 'getorder', 'getuser', 'getdeliverytime', 'getdeliveryaddress')->get();

        return view('backend.admin.orders.totalorder', get_defined_vars());
    }
}
