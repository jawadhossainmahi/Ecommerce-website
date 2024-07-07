<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Orders;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {

        $list = User::where('role', '1')->with('getorders')->latest()->orderByDesc('created_at')->get();
        // $users = User::select('id','email','name','status')->latest()->paginate(5);

        return view('backend.admin.customers.index', get_defined_vars());
    }
    public function order_history($user_id)
    {
        $list = Orders::where('user_id', $user_id)->orderByDesc('created_at')->get();
        return view('backend.admin.user_order_history.index', get_defined_vars());
    }
    // here single select user data 

    public function selectedit($id)
    {

        $customers = User::where('id', $id)->first();
        $data = compact('customers');

        return view('backend.admin.customers.select')->with($data);
    }
    // update user data on customers 
    public function update($id, Request $request)
    {

        $up_data = User::where('id', $id)->first();
        $up_data->name = $request['name'];
        $up_data->l_name = $request['l_name'];
        $up_data->email = $request['email'];
        $up_data->phone = $request['phone'];
        $up_data->postal_code = $request['postal_code'];
        $up_data->city = $request['city'];
        $up_data->address = $request['address'];
        $up_data->date_of_birth = $request['data_of_birth'];

        $up_data->save();

        return redirect()->back();
    }

    // delete user single data

    public function deleted($id)
    {
        $deleteds = User::find($id);

        if (!$deleteds == "") {
            $deleteds->delete();

            return redirect()->back();
        }
    }

    public function filter(Request $request)
    {
        return $request;
        // return response($request['customer']);
        $startDate = Carbon::createFromFormat('d/m/Y', '01/01/2021');
        $endDate = Carbon::createFromFormat('d/m/Y', '06/01/2021');

        $users = User::select('id', 'name', 'email', 'created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $currentYear = now()->year;

        $query = User::query();

        if ($request['customer'] == date('Y')) {
            $query->where('role', '1')->whereYear('created_at', $request['customer'])->with('getorders')->latest()->orderByDesc('created_at');
        }

        if ($request['customer'] == date('m')) {
            $month = date('m');
            $query->where('role', '1')->with('getorders')->whereYear('created_at', $currentYear)->latest()->orderByDesc('created_at');
        }

        if ($request['customer'] == date('d')) {
            $day = date('d');
            $query->where('role', '1')->with('getorders')->whereYear('created_at', $currentYear)->latest()->orderByDesc('created_at');
        }

        $newCustomers = $query->get();

        return response($newCustomers);
    }
}
