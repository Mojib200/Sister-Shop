<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Validator;

use illuminate\Validation\Rules\Password;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class usercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function users()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $total_users = User::count();
        return view('admin\users\users', compact('users', 'total_users'));
    }




    function profile()
    {
        return view('admin\users\profile');
    }
    function name_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',


        ], [
            'name.required' => 'Entry this name',
            'email.required' => 'Entry this Email',
        ]);

        User::find(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);
        return back()->with('update', 'WOW finally update done');
    }


    //Profile Photo

    function profile_photo(Request $request)
    {
        $request->validate([
            'profile_photo' =>'required|file|max:5120|mimes:jpg,bmp,png,gif',
        ]);
        $upload_file = $request->profile_photo;
        if (Auth::user()->profile_photo == null) {
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($upload_file)->resize(300,200)->save(public_path('uploads/profile_photo/'.$file_name));
            User::find(Auth::id())->update([
                'profile_photo' => $file_name,
            ]);
            return back()->with('profile_photo_success', 'WOW finally Profile Photo Upload done');
        }
        else {
            $delete_from = public_path('uploads/profile_photo/'.Auth::user()->profile_photo);
            unlink($delete_from);
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($upload_file)->resize(300,200)->save(public_path('uploads/profile_photo/'.$file_name));

            User::find(Auth::id())->update([
                'profile_photo' => $file_name,
            ]);
            $notification = array(
                'message' => 'WOW finally Profile Photo update done !',
                'alert-type' => 'success'
            );
            return back()->with($notification);


    }
}
    //End Profile Photo

    function password_update(Request $request)
    {
        // $request->validate([
        //     'old_password' => 'required',
        // 'password'=>Password::min(8)
        // ->letters()
        // ->mixedCase()
        // ->numbers()
        // ->symbols(),
        // 'password' => 'required|confirm',
        //     'password_confirmation' => 'required',
        // ],
        $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|confirmed|min:8|',
                'password_confirmation' => 'required',
            ],
            [
                'old_password.required' => 'Entry this old password',
                'password.required' => 'Entry this password',
                'password.min' => 'Entry minimum 8 digit  password',
                'password_confirmation.required' => 'Entry this password confirmation',
            ]
        );
        if (Hash::check($request->old_password, Auth::user()->password)) {
            User::find(Auth::id())->update([

                'password' => $request->password,
            ]);
            $notification = array(
                'message' => 'WOW finally Password update done!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Old Password Not Correct So Password Change Impossible PlZ Correct Password Insert !',
                'alert-type' => 'success'
            );
            return back()->with($notification);

        }
    }
    function user_register(Request $request){
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message' => 'New User Add Finally',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
