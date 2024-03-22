<?php

namespace App\Http\Controllers;


use App\Models\Billing_Details;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    function check_out()
    {
        $info_cart = Cart::where('customer_id', Auth::guard('customer_logins')->id())->get();
        $countrys = Country::all();

        return view('frontend\checkout', ['info_cart' => $info_cart, 'countrys' => $countrys]);
    }
    function ajax_check_city_country(Request $request)
    {
        $str = '<option value="">-- Select City --</option>';
        $citys = City::where('country_id', $request->country_id)->get();

        foreach ($citys as $city) {
            $str .= ' <option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $str;
    }
    function order_confirm(Request $request)
    {
        if ($request->payment_method == 1) {
            $order_id = '#' . Str::upper(Str::random(3)) . '-' . rand(99999999, 10000000);
            Order::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer_logins')->id(),
                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'charge' => $request->charge,
                'total' => $request->subtotal + $request->charge,
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now(),

            ]);
            Billing_Details::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer_logins')->id(),
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'customer_number' => $request->customer_number,
                'company_name' => $request->company_name,
                'customer_address' => $request->customer_address,
                'customer_zip' => $request->customer_zip,
                'customer_country_id' => $request->customer_country_id,
                'customer_city_id' => $request->customer_city_id,
                'customer_notes' => $request->customer_notes,
                'created_at' => Carbon::now(),
            ]);
            $order_product_infos = Cart::where('customer_id', Auth::guard('customer_logins')->id())->get();
            foreach ($order_product_infos as $order_product_info) {
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer_logins')->id(),
                    'product_id' => $order_product_info->product_id,
                    'price' => $order_product_info->relation_to_product_info->product_after_discount_price,
                    'color_id' => $order_product_info->color_id,
                    'size_id' => $order_product_info->size_id,
                    'quantity' => $order_product_info->quantity,
                    'created_at' => Carbon::now(),

                ]);


                //product quantity order Confirm then decrement Code
                Inventory::where('product_id', $order_product_info->product_id)->where('color_id', $order_product_info->color_id)->where('size_id', $order_product_info->size_id)->decrement('quantity', $order_product_info->quantity);
            }
            // sent mail code Start
            Mail::to($request->email)->send(new InvoiceMail($order_id));
            // sent mail code stop

            // //SMS Start
            // $url = "http://bulksmsbd.net/api/smsapi";
            // $api_key = "Mlx8NPW0AVJ8XUAWjvIn";
            // $senderid = "Mojib200";
            // $number = $request->customer_number;
            // $message = "Congratulation!! Your order has been successfully done.Please Ready TK:" . $request->subtotal + $request->charge;

            // $data = [
            //     "api_key" => $api_key,
            //     "senderid" => $senderid,
            //     "number" => $number,
            //     "message" => $message,
            // ];
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // $response = curl_exec($ch);
            // curl_close($ch);
            // return $response;
            // //SMS Stop
            Cart::where('customer_id', Auth::guard('customer_logins')->id())->delete();
            $notification = array(
                'message' => 'Place Your Order Information Store Successfully Done',
                'alert-type' => 'success',

            );
            return redirect()->route('order_confirm_success')->with($notification)->withOrder($order_id);
        } else if ($request->payment_method == 2) {
            $all_data=$request->all();
           return redirect()->route('pay')->with('all_data',$all_data);
        } else {
            $all_data=$request->all();
           return redirect()->route('stripe')->with('all_data',$all_data);
        }
    }
    function order_confirm_success()
    {
        if (session('order')) {
            $order_id = session('order');
            return view('frontend\product_order_success', ['order_id' => $order_id,]);
        } else {
            abort('404');
        }
    }
}
