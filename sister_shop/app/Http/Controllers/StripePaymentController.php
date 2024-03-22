<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Billing_Details;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Sslorder;
use App\Models\Stripe_orders;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $all_data = session('all_data');
       $stripe_orders_id= Stripe_orders::insertGetId([
            'name' => $all_data['customer_name'],
            'email' => $all_data['email'],
            'phone' => $all_data['customer_number'],
            'address' => $all_data['customer_address'],
            'company_name' => $all_data['company_name'],
            'customer_zip' => $all_data['customer_zip'],
            'customer_country_id' => $all_data['customer_country_id'],
            'customer_city_id' => $all_data['customer_city_id'],
            'customer_notes' => $all_data['customer_notes'],
            'charge' => $all_data['charge'],
            'payment_method' => $all_data['payment_method'],
            'subtotal' => $all_data['subtotal'],
            'discount' => $all_data['discount'],
            'customer_id' => $all_data['customer_id'],
            'total'=>$all_data['subtotal']+$all_data['charge'],
            'created_at' => Carbon::now(),

        ]);

        return view('frontend\stripe',[
            'all_data'=>$all_data,
            'stripe_orders_id'=>$stripe_orders_id,
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $all_stripe_order_info=Stripe_orders::where('id',$request->stripe_orders_id)->get();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $all_stripe_order_info->first()->total * 100,
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);



        $order_id = '#' . Str::upper(Str::random(3)) . '-' . rand(99999999, 10000000);
        Order::insert([
            'order_id' => $order_id,
            'customer_id' => $all_stripe_order_info->first()->customer_id,
            'subtotal' => $all_stripe_order_info->first()->subtotal,
            'discount' => $all_stripe_order_info->first()->discount,
            'charge' => $all_stripe_order_info->first()->charge,
            'total' =>  $all_stripe_order_info->first()->total,
            'payment_method' => $all_stripe_order_info->first()->payment_method,
            'created_at' => Carbon::now(),

        ]);
        Billing_Details::insert([
            'order_id' => $order_id,
            'customer_id' => $all_stripe_order_info->first()->customer_id,

            'customer_name' => $all_stripe_order_info->first()->name,
            'email' => $all_stripe_order_info->first()->email,
            'customer_number' =>$all_stripe_order_info->first()->phone,
            'company_name' =>$all_stripe_order_info->first()->company_name,
            'customer_address' => $all_stripe_order_info->first()->address,


            'customer_zip' => $all_stripe_order_info->first()->customer_zip,
            'customer_country_id' =>$all_stripe_order_info->first()->customer_country_id,
            'customer_city_id' => $all_stripe_order_info->first()->customer_city_id,
            'customer_notes' => $all_stripe_order_info->first()->customer_notes,
            'created_at' => Carbon::now(),
        ]);
        $order_product_infos = Cart::where('customer_id', $all_stripe_order_info->first()->customer_id)->get();
        foreach ($order_product_infos as $order_product_info) {
            OrderProduct::insert([
                'order_id' => $order_id,
                'customer_id' => $all_stripe_order_info->first()->customer_id,
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
        Mail::to($all_stripe_order_info->first()->email)->send(new InvoiceMail($order_id));
        // sent mail code stop

        // //SMS Start
        // $url = "http://bulksmsbd.net/api/smsapi";
        // $api_key = "Mlx8NPW0AVJ8XUAWjvIn";
        // $senderid = "Mojib200";
        // $number = $all_stripe_order_info->first()->customer_number;
        // $message = "Congratulation!! Your order has been successfully done.Please Ready TK:" . $all_stripe_order_info->first()->subtotal + $all_stripe_order_info->first()->charge;

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
        Cart::where('customer_id', $all_stripe_order_info->first()->customer_id)->delete();
        $notification = array(
            'message' => 'Place Your Order Information Store Successfully Done',
            'alert-type' => 'success',

        );
        return redirect()->route('order_confirm_success')->with($notification)->withOrder($order_id);
    }
}
