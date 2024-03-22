<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRegisterRequest;
use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Customer_LoginController extends Controller
{
    function customer_login_this(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $login_info = $request->only('email', 'password');
        if (Auth::guard('customer_logins')->attempt($login_info)) {
            if (Auth::guard('customer_logins')->user()->email_varifie == null) {
                $notification = array(
                    'message_1' => 'Please Email Verification Frist Then Login!!!',
                    'alert-type' => 'success'
                );
                return redirect()->route('index')->with($notification);
            } else {
                return redirect('/')->with('success_login', 'Customer Login Successfully');
            }
        } else {
            return redirect('customer_logins');
        }
    }
    function customer_logout()
    {
        Auth::guard('customer_logins')->logout();
        return redirect('/')->with('success_login', 'Customer Login Successfully');
    }
}
