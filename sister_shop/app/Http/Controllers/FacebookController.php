<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    // function facebook_redirect()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // function facebook_callback()
    // {
    //     $user = Socialite::driver('facebook')->user();
    //     if (CustomerLogin::where('email', $user->getEmail())->exists()) {
    //         if (Auth::guard('customer_logins')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
    //             return redirect('/');
    //         }
    //     } else {
    //         Customerlogin::insert([
    //             'customer_name' => $user->getName(),
    //             'email' => $user->getEmail(),
    //             'password' => bcrypt('abc@123'),
    //             'email_varifie'=>Carbon::now(),
    //         ]);

    //         if (Auth::guard('customer_logins')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
    //             return redirect('/');
    //         }
    //     }
    // }


}
