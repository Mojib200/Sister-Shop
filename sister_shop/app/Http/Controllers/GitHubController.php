<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    function github_redirect()
    {
        return Socialite::driver('github')->redirect();
    }
    function github_callback()
    {
        $user = Socialite::driver('github')->user();
        if (Customerlogin::where('email', $user->getEmail())->exists()) {
            if (Auth::guard('customer_logins')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
                $notification = array(
                    'message' => 'Successfully Your GitHub Account Login !!',
                    'alert-type' => 'success'
                );
                return redirect('/')->with($notification);


            }
        } else {
            Customerlogin::insert([
                'customer_name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc@123'),
                'email_varifie'=>Carbon::now(),
            ]);

            if (Auth::guard('customer_logins')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
                $notification = array(
                    'message' => 'Successfully Your GitHub Account Login !!',
                    'alert-type' => 'success'
                );
                return redirect('/')->with($notification);
            }
        }
    }

}
