<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class Cart_Controller extends Controller
{
    function cart_store(Request $request)
    {
        if($request->cart_or_wish==1){
            if (Auth::guard('customer_logins')->check())
            {
                if (Auth::guard('customer_logins')->user()->email_varifie != null){
                    if( $request->quantity> Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity){

                        $notification = array(
                            'message' => ' Choose Quantity Are Not Available So Choose Quantity Minimum Please .Available Stock Total :  '.Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity,
                            'alert-type' => 'success'
                        );
                        return back()->with($notification);
                    }
                    else{

                        Cart::insert([
                            'customer_id'=>Auth::guard('customer_logins')->id(),
                            'product_id'=>$request->product_id,
                            'color_id'=>$request->color_id,
                            'size_id'=>$request->size_id,
                            'quantity'=>$request->quantity,
                            'created_at' => Carbon::now(),
                           ]);
                           $notification = array(
                            'message' => 'Cart Added Success',
                            'alert-type' => 'success'
                        );
                       return redirect('/')->with($notification);
                    }
                }
                else
                {
                    $notification = array(
                        'message_1' => 'Please Email Verification',
                        'alert-type' => 'success'
                    );
                   return redirect('/customer_logins')->with($notification);
                }


            }
            else{
                $notification = array(
                    'message_1' => 'Please Login And Register',
                    'alert-type' => 'success'
                );
               return redirect('/customer_logins')->with($notification);
            }

        }
        else{
            Wishlist::insert([
                'customer_id'=>Auth::guard('customer_logins')->id(),
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'created_at' => Carbon::now(),
               ]);
               $notification = array(
                'message' => 'Wishlist Added Success',
                'alert-type' => 'success'
            );
           return redirect('/')->with($notification);
        }


    }
    function remove_wishlist($id)
    {
        Wishlist::find($id)->delete();
        $notification = array(
            'message' => 'Remove This product In Wishlist  Success',
            'alert-type' => 'success'
        );
       return back()->with($notification);
    }
    function remove_cart($id)
    {
        Cart::find($id)->delete();
        $notification = array(
            'message' => 'Remove This product In Cart  Success',
            'alert-type' => 'success'
        );
       return back()->with($notification);
    }
    function delete_all_cart()
    {
        Cart::where('customer_id',Auth::guard('customer_logins')->id())->Delete();
        $notification = array(
            'message' => 'Cart Clear All Product No Product Selected',
            'alert-type' => 'success'
        );
       return back()->with($notification);
    }
    function delete_all_wishlist()
    {
        Wishlist::where('customer_id',Auth::guard('customer_logins')->id())->Delete();
        $notification = array(
            'message' => 'Wishlist Clear All Product No Product Selected',
            'alert-type' => 'success'
        );
       return back()->with($notification);
    }

    function view_cart(Request $request)
    {
        $cart_infos=Cart::where('customer_id',Auth::guard('customer_logins')->id())->get();
        $coupon_codes=$request->coupon_code;
        $discount=0;
        $message='';
        $copon_type='';
        if($coupon_codes=='')
        {
            $discount=0;
        }

        else{
            if(Coupon::where('copon_code',$coupon_codes)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupon::where('copon_code',$coupon_codes)->first()->validity)
                {
                    $discount=0;
                    $message='Coupon Code Expired!';
                }
                else
                {
                    $discount=Coupon::where('copon_code',$coupon_codes)->first()->discount_amount;
                    $copon_type=Coupon::where('copon_code',$coupon_codes)->first()->copon_type;
                }

            }
            else
            {
                $discount=0;
                $message='Invalid Coupon Code';
            }

        }
        return view('frontend\view_cart',['cart_infos'=>$cart_infos,'coupon_codes'=>$coupon_codes,'message'=>$message,'discount'=>$discount,'copon_type'=>$copon_type]);
    }
    function view_wishlist(Request $request)
    {
        $wishlist_infos=Wishlist::where('customer_id',Auth::guard('customer_logins')->id())->get();
       return view('frontend\wishlist\wishlist',['wishlist_infos'=>$wishlist_infos,]);
}
    function remove_view($id)
    {
        Cart::find($id)->delete();
        $notification = array(
            'message' => 'Remove This product View Page  Success',
            'alert-type' => 'success'
        );
        return redirect('/')->with($notification);
    }
    function update_cart(Request $request)
    {
        foreach ($request->quantity as $cart_id => $quantity) {
        Cart::find($cart_id)->update([
            'quantity'=>$quantity,
            'updated_at' => Carbon::now(),

        ]);
        }
        $notification = array(
            'message' => 'Update This product View Page  Success',
            'alert-type' => 'success'
        );
        return redirect('/view_cart')->with($notification);
    }
}
