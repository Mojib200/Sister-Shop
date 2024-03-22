<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Sslorder;
use Illuminate\Support\Carbon;

use App\Models\Billing_Details;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Str;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $all_data = session('all_data');
        $total_pay=$all_data['subtotal']+$all_data['charge'];
        $post_data = array();
        $post_data['total_amount'] =  $total_pay; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('sslorders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $all_data['customer_name'],
                'email' => $all_data['email'],
                'phone' => $all_data['customer_number'],
                'amount' =>  $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $all_data['customer_address'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
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
                'created_at' => Carbon::now(),
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('sslorders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
       $all_ssl_order_info=Sslorder::where('transaction_id',$tran_id)->get();

       $order_id = '#' . Str::upper(Str::random(3)) . '-' . rand(99999999, 10000000);
       Order::insert([
           'order_id' => $order_id,
           'customer_id' => $all_ssl_order_info->first()->customer_id,
           'subtotal' => $all_ssl_order_info->first()->subtotal,
           'discount' => $all_ssl_order_info->first()->discount,
           'charge' => $all_ssl_order_info->first()->charge,
           'total' => $request->input('amount'),
           'payment_method' => $all_ssl_order_info->first()->payment_method,
           'created_at' => Carbon::now(),

       ]);
       Billing_Details::insert([
           'order_id' => $order_id,
           'customer_id' => $all_ssl_order_info->first()->customer_id,

           'customer_name' => $all_ssl_order_info->first()->name,
           'email' => $all_ssl_order_info->first()->email,
           'customer_number' =>$all_ssl_order_info->first()->phone,
           'company_name' =>$all_ssl_order_info->first()->company_name,
           'customer_address' => $all_ssl_order_info->first()->address,


           'customer_zip' => $all_ssl_order_info->first()->customer_zip,
           'customer_country_id' =>$all_ssl_order_info->first()->customer_country_id,
           'customer_city_id' => $all_ssl_order_info->first()->customer_city_id,
           'customer_notes' => $all_ssl_order_info->first()->customer_notes,
           'created_at' => Carbon::now(),
       ]);
       $order_product_infos = Cart::where('customer_id', $all_ssl_order_info->first()->customer_id)->get();
       foreach ($order_product_infos as $order_product_info) {
           OrderProduct::insert([
               'order_id' => $order_id,
               'customer_id' => $all_ssl_order_info->first()->customer_id,
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
       Mail::to($all_ssl_order_info->first()->email)->send(new InvoiceMail($order_id));
       // sent mail code stop

       // //SMS Start
       // $url = "http://bulksmsbd.net/api/smsapi";
       // $api_key = "Mlx8NPW0AVJ8XUAWjvIn";
       // $senderid = "Mojib200";
       // $number = $all_ssl_order_info->first()->customer_number;
       // $message = "Congratulation!! Your order has been successfully done.Please Ready TK:" . $all_ssl_order_info->first()->subtotal + $all_ssl_order_info->first()->charge;

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
       Cart::where('customer_id', $all_ssl_order_info->first()->customer_id)->delete();
       $notification = array(
           'message' => 'Place Your Order Information Store Successfully Done',
           'alert-type' => 'success',

       );
       return redirect()->route('order_confirm_success')->with($notification)->withOrder($order_id);
    //     echo "Transaction is Successful";

    //     $tran_id = $request->input('tran_id');
    //     $amount = $request->input('amount');
    //     $currency = $request->input('currency');

    //     $sslc = new SslCommerzNotification();

    //     #Check order status in order tabel against the transaction id or order id.
    //     $order_details = DB::table('sslorders')
    //         ->where('transaction_id', $tran_id)
    //         ->select('transaction_id', 'status', 'currency', 'amount')->first();

    //     if ($order_details->status == 'Pending') {
    //         $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

    //         if ($validation) {
    //             /*
    //             That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
    //             in order table as Processing or Complete.
    //             Here you can also sent sms or email for successfull transaction to customer
    //             */
    //             $update_product = DB::table('sslorders')
    //                 ->where('transaction_id', $tran_id)
    //                 ->update(['status' => 'Processing']);

    //             echo "<br >Transaction is successfully Completed";
    //         }
    //     } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
    //         /*
    //          That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
    //          */
    //         echo "Transaction is successfully Completed";
    //     } else {
    //         #That means something wrong happened. You can redirect customer to your product page.
    //         echo "Invalid Transaction";
    //     }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('sslorders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('sslorders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('sslorders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('sslorders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('sslorders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('sslorders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
