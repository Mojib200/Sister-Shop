<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRegisterRequest;
use App\Models\CustomerEmailVarification;
use App\Models\CustomerLogin;
use App\Notifications\CustomerEmailVarificationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Laravel\Socialite\Facades\Socialite;

class CustomerRegisterController extends Controller
{

    function customer_register_store(CustomerRegisterRequest $request)
    {
        // $password = Hash::make('$request->customer_password');
        CustomerLogin::insert([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),

        ]);
        $customer_info = CustomerLogin::where('email', $request->email)->firstOrFail();
        $customer_register_info = CustomerEmailVarification::create([
            'customer_varifie_id' => $customer_info->id,
            'customer_varifie_token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);
        Notification::send($customer_info, new CustomerEmailVarificationNotification($customer_register_info));
        $notification = array(
            'message' => 'OTP Code Send Your Email !! Please Email Verification',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }
    function customer_email_varifie_form($customer_varifie_tokens)
    {

        $customer_varifie_token = CustomerEmailVarification::where('customer_varifie_token', $customer_varifie_tokens)->firstOrFail();
        CustomerLogin::find($customer_varifie_token->customer_varifie_id)->update([
            'email_varifie' => Carbon::now()->format('Y-m-d'),
        ]);
        $customer_varifie_token->delete();

        $notification = array(
            'message' => 'Successfully Done  Email Verification',
            'alert-type' => 'success'
        );
        return back()->with($notification);


    }
}
