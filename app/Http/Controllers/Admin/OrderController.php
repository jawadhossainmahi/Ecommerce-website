<?php

namespace App\Http\Controllers\Admin;

use App\DataTableHelper;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderList;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCancelEmail;
use App\Mail\OrderDeliveredEmail;
use App\Models\OrderDetail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Orders::with(['getdeliveryaddress', 'getdeliverytime'])->latest();

            return DataTableHelper::create($query)
                ->addAutoIndex()
                ->columns(function ($row) {
                    return [
                        'order_id' => $row->custom_order_id ?: $row->id,
                        'user_name' => $row->getdeliveryaddress->fname . ' ' . $row->getdeliveryaddress->lname,
                        'user_email' => $row->getdeliveryaddress->email,
                        'delivery_time' => $row->getdeliverytime->date . " {$row->getdeliverytime->start_time} - {$row->getdeliverytime->end_time}",
                        'status' => match ($row->status) {
                            2 => '<span class="badge badge-danger">Cancelled</span>',
                            1 => '<span class="badge badge-success">Completed</span>',
                            0 => '<span class="badge badge-primary">Pending</span>',
                        },
                        'created_at' => $row->created_at?->toDateTimeString(),
                        'handle' => Blade::render(<<<'HTML'
                            <a href="{{ route('admin.order.edit', ['orders' => $item->id]) }}">
                                <i class="bx bx-edit-alt" style="color: green;"></i>
                            </a>
                            <a href="{{ route('admin.order.destroy', ['orders' => $item->id]) }}" onclick="return confirm('Are you sure To Delete This?')">
                                <i class="bx bx-trash-alt" style="color: green;"></i>
                            </a>
                        HTML , ['item' => $row])
                    ];
                })
                ->filter(function ($build, $keyword) {
                    return [
                        'user_name' => $build->orWhereRelation('getdeliveryaddress', 'like', "%$keyword%"),
                        'user_email' => $build->orWhereRelation('getdeliveryaddress', 'email', "%$keyword%"),
                        'delivery_time' => $build->orWhereRelation('getdeliverytime', 'date', "%$keyword%"),
                        'order_id' => $build->orWhere('custom_order_id', 'like', "%$keyword%"),
                    ];
                })
                ->json();
        }

        return view('backend.admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where("role", '1')->orderByDesc('created_at')->get();
        $product = Product::orderByDesc('created_at')->get();
        return view('backend.admin.orders.create', get_defined_vars());
    }


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
     */
    public function edit(Orders $orders)
    {
        list($discount_without_coupons, $total, $total_discount, $tax, $totalTaxAmt12, $totalTaxAmt25) = order_details($orders);
        return view('backend.admin.orders.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
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

    public function showCopyOrder(Orders $orders)
    {
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
     */
    public function update(Request $request, Orders $orders)
    {
        $request->validate([
            'status' => 'required',
        ]);

        if (!empty($request->items)) {
            $baseId = $orders->custom_order_id;
            $maxSuffix = Orders::where('custom_order_id', $baseId)->orWhere('custom_order_id', 'like',"$baseId-%")->count()-1;

            preg_match("/^([^-]*)-(.*)$/", $baseId, $matches);

            if (count($matches) > 1) {
                $baseId = $matches[1];
                if ($maxSuffix < $matches[2]) {
                    $maxSuffix = $matches[2];
                }
            }

            $totalPrice = 0;
            $productPrices = $request->items['product_price'] ?? [];
            $quantities = $request->items['qty'] ?? [];
            foreach ($productPrices as $key => $price) {
                $qty = $quantities[$key] ?? 0;
                $price = $productPrices[$key] ?? 0;
                $totalPrice += $price * $qty;
            }

            $clonedOrder = $orders->replicate();
            $clonedOrder->id = Str::uuid();
            $clonedOrder->total_price = $totalPrice ?? 0;
            $clonedOrder->save();
            $clonedOrder->custom_order_id = $baseId . '-' . ($maxSuffix + 1);
            $clonedOrder->save();

            $quantities = $request->items['qty'] ?? [];
            $itemIds = $request->items['item_id'] ?? [];
            /*foreach ($itemIds as $key => $itemId) {
                $orderlist = new OrderList();
                $orderlist->order_id = $clonedOrder->id;
                $orderlist->qty = $quantities[$key] ?? 0;
                $orderlist->product_id = $request->items['product_id'][$key] ?? null;
                $orderlist->save();
            }*/
            foreach ($itemIds as $key => $itemId) {
                $orderlist = new OrderDetail();
                $orderlist->product_id = $request->items['product_id'][$key] ?? null;
                $orderlist->order_id = $clonedOrder->id;
                $orderlist->qty = $quantities[$key] ?? 0;
                $orderlist->save();
            }

            $orders->status = 2;
            $orders->save();

            return redirect()->route('admin.order.edit', $clonedOrder->id)->with('message', "Order Cloned and Updated Successfully!");
        }

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


        if ($order->getuser->customer_type == 1) {
            $order->status = 2;
            $order->getdeliverytime->status = 1;
            $order->save();

            if ($order->getuser->email) {
                Mail::to($order->getuser->email)->send(new OrderCancelEmail($order));
            }
            Mail::to(env("MAIL_BCC_ADDRESS"))->send(new OrderCancelEmail($order, true));

            return response()->json("Data Updated Successfully!");
        } else {

            $check = $this->cancelOrder($order->id);
            if ($check['code'] == "201") {

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
     * @return Response
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
