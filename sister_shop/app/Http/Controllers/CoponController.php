<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CoponController extends Controller
{
    function copon()
    {
        $coupons = Coupon::all();

        return view('admin\users\copon\add_copon', ['coupons' => $coupons,]);
    }
    function coupon_store(Request $request)
    { $request->validate([
        'copon_code' => 'required',
        'copon_type' => 'required',
        'discount_amount' => 'required',
        'validity' => 'required',
    ]);
        Coupon::insert([
            'copon_code' => $request->copon_code,
            'copon_type' => $request->copon_type,
            'discount_amount' => $request->discount_amount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon Add Success  !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    function coupon_delete($id)
    {

        Coupon::find($id)->delete();
        $notification = array(
            'message' => 'Coupon Delete  Successfully  !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
