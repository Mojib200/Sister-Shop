<?php

namespace App\Http\Controllers;

use App\Models\Customer_Pass_Request;
use App\Models\CustomerLogin;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Notifications\CustomerResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    function customer_profile()
    {
        // $customer_info=CustomerLogin::all();
        // ,['customer_info' =>$customer_info]
        return view('frontend\customer_profile');
    }

    function customer_profile_update(Request $request)
    {
        if ($request->password == '') {
            $upload_file = $request->customer_photo;
            if (Auth::guard('customer_logins')->user()->customer_photo == null) {
                $extension = $upload_file->getClientOriginalExtension();
                $file_name = Auth::guard('customer_logins')->user()->id . '.' . $extension;
                Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/customer_photo/' . $file_name));
                CustomerLogin::find(Auth::guard('customer_logins')->user()->id)->update([
                    'customer_name' => $request->customer_name,
                    'email' => $request->email,
                    'customer_country' => $request->customer_country,
                    'customer_address' => $request->customer_address,
                    'customer_photo' => $file_name,
                ]);
                $notification = array(
                    'message' => 'WOW finally Customer Profile Photo update done !',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            } else {
                $delete_from = public_path('uploads/customer_photo/' . Auth::guard('customer_logins')->user()->customer_photo);
                unlink($delete_from);
                $extension = $upload_file->getClientOriginalExtension();
                $file_name = Auth::guard('customer_logins')->user()->id . '.' . $extension;
                Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/customer_photo/' . $file_name));

                CustomerLogin::find(Auth::guard('customer_logins')->user()->id)->update([
                    'customer_name' => $request->customer_name,
                    'email' => $request->email,
                    'customer_country' => $request->customer_country,
                    'customer_address' => $request->customer_address,
                    'customer_photo' => $file_name,
                ]);
                $notification = array(
                    'message' => 'WOW finally Customer Profile  update done !',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }
        } else {
            if (Hash::check($request->old_password, Auth::guard('customer_logins')->user()->password)) {
                $upload_file = $request->customer_photo;
                if (Auth::guard('customer_logins')->user()->customer_photo == null) {
                    $extension = $upload_file->getClientOriginalExtension();
                    $file_name = Auth::guard('customer_logins')->user()->id . '.' . $extension;
                    Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/customer_photo/' . $file_name));
                    CustomerLogin::find(Auth::guard('customer_logins')->user()->id)->update([
                        'customer_name' => $request->customer_name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'customer_country' => $request->customer_country,
                        'customer_address' => $request->customer_address,
                        'customer_photo' => $file_name,
                    ]);
                    $notification = array(
                        'message' => 'WOW finally Customer Profile Photo and Password  update done !',
                        'alert-type' => 'success'
                    );
                    return back()->with($notification);
                } else {
                    $delete_from = public_path('uploads/customer_photo/' . Auth::guard('customer_logins')->user()->customer_photo);
                    unlink($delete_from);
                    $extension = $upload_file->getClientOriginalExtension();
                    $file_name = Auth::guard('customer_logins')->user()->id . '.' . $extension;
                    Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/customer_photo/' . $file_name));

                    CustomerLogin::find(Auth::guard('customer_logins')->user()->id)->update([
                        'customer_name' => $request->customer_name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'customer_country' => $request->customer_country,
                        'customer_address' => $request->customer_address,
                        'customer_photo' => $file_name,
                    ]);
                    $notification = array(
                        'message' => 'WOW finally Customer Profile And Passord  update done !',
                        'alert-type' => 'success'
                    );
                    return back()->with($notification);
                }
            } else {
                $notification = array(
                    'message_1' => 'Old Password and New Password Dose Not Match!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }
        }
    }
    function customer_my_order_list()
    {
        $order_infos = Order::where('customer_id', Auth::guard('customer_logins')->id())->get();
        return view('frontend\customer_order_page', ['order_infos' => $order_infos]);
    }
    function review_store(Request $request)
    {
        if ($request->image == '') {

            OrderProduct::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update([
                'review' => $request->review,
                'star' => $request->star,
            ]);
            $notification = array(
                'message' => 'Review  Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $image_load = $request->image;
            $extension = $image_load->getClientOriginalExtension();
            $image_name = $request->customer_id . '.' . $extension;
            Image::make($image_load)->resize(300, 200)->save(public_path('uploads/review/review_photo/' .  $image_name));
            OrderProduct::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update([
                'review' => $request->review,
                'star' => $request->star,
                'image' =>  $image_name,
            ]);
            $notification = array(
                'message' => 'Review Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }
    function customer_password_reset_request()
    {
        return view('frontend\customer_reset_password\cust_reset_pass_reqest');
    }
    function customer_pass_reset_send_request(Request $request)
    {
        $customer_info = CustomerLogin::where('email', $request->email)->firstOrFail();
        Customer_Pass_Request::where('customer_id', $customer_info->id)->delete();
        $customer_insert_info = Customer_Pass_Request::create([
            'customer_id' => $customer_info->id,
            'customer_token' => uniqid(),
            'created_at' => now(),
        ]);
        Notification::send($customer_info, new CustomerResetNotification($customer_insert_info));
        $notification = array(
            'message' => 'OTP Code Send Your Email',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    function customer_pass_reset_form($customer_token)
    {

        return view('frontend\customer_reset_password\customer_pass_reset_form',['customer_token'=>$customer_token]);
    }
    function customer_pass_reset(Request $request)
    {
        $customer_reset_info=Customer_Pass_Request::where('customer_token',$request->customer_token)->firstOrFail();
        CustomerLogin::findOrFail($customer_reset_info->customer_id)->update([
            'password'=>Hash::make($request->password),
        ]);
        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        $customer_reset_info->delete();
        return redirect()->route('customer_logins')->with($notification);
    }
}
