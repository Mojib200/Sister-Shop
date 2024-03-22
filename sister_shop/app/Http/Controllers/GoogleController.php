<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    function google_callback()
    {
        $user = Socialite::driver('google')->user();
        if (Customerlogin::where('email', $user->getEmail())->exists()) {
            if (Auth::guard('customer_logins')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
                return redirect('/');
            }
        } else {
            Customerlogin::insert([
                'customer_name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc@123'),
                'email_varifie'=>Carbon::now(),
            ]);

            if (Auth::guard('customer_logins')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
                return redirect('/');
            }
        }
    }



}
