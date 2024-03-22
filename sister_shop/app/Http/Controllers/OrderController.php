<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   function orders_dashboard()
   {
    $orders=Order::all();
    return view('admin\users\order\order',['orders'=>$orders]);
   }
   function order_status(Request $request)
   {
    $status_explode=explode(',',$request->status);
   $order_id=$status_explode[0];
   $status_id=$status_explode[1];
   Order::where('order_id',$order_id)->update([
'status'=>$status_id,

   ]);
   return back();

   }
   function download_invoice($order_id)
   {
    $order_info = Order::find($order_id);
    $pdf = Pdf::loadView('frontend.download.download',[
        'order_id'=>$order_info->order_id,
    ]);
    return  $pdf->download('invoice.pdf');

   }
}
