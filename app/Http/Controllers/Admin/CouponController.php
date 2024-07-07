<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $random = Str::random(10);
        $list = Coupon::orderByDesc('created_at')->get();
        return view('backend.admin.coupons.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.coupons.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coupon $coupon)
    {
        $request->validate(
            [
                'name'        => 'required',
                'start_date'        => 'required',
                'end_date'        => 'required||date|after:start_date',
                'code' => 'required'
            ]
            // [
            //     'required'  => 'The :attribute field is required.',
            //     ]

        );

        //$data = $request->all();


        //return $request;


        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->amount = $request->amount;
        $coupon->max_discount = $request->max_discount;
        $coupon->type = $request->type;
        $coupon->code = $request->code;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->save();


        return redirect()->route('admin.coupons.index')->with('message', "Data Added Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('backend.admin.coupons.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name'        => 'required',
            'start_date'        => 'required|date',
            'end_date'        => 'required||date|after:start_date',
        ]);
        // $code= Str::random(8);
        // $request->request->add(['code' => $code]);
        // $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->amount = $request->amount;
        $coupon->max_discount = $request->max_discount;
        $coupon->type = $request->type;
        $coupon->code = $request->code;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->save();

        // $coupon->update($request->all());
        return redirect()->route('admin.coupons.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('warning', "Data Deleted Successfully!");
    }
}
