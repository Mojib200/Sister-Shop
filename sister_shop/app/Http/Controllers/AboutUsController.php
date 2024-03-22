<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AboutUsController extends Controller
{
    function about()
    {
        $about_us_info=AboutUs::all()->first();
        $contact_information=Contact::all()->first();
        return view('frontend\aboutus',['about_us_info'=>$about_us_info,'contact_information'=>$contact_information]);
    }
    function about_us_back()
    {
        return view('admin\users\about_us\about_us_back');
    }

    function founder_about_us(Request $request)
    {

        if (AboutUs::all() == '[]') {
             //profile_photo
        $profile_name = str_replace('', '-', str::lower($request->founder_name)) . '-' . rand(1000000, 99999999);
        $upload_file = $request->profile_photo;
        $extension = $upload_file->getClientOriginalExtension();
        $file_profile_name = $profile_name . '.' . $extension;
        Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/about_us_photo/profile_photo/' . $file_profile_name));

        //cover_photo
        $cover_name = str_replace('', '-', str::lower($request->founder_name)) . '-' . rand(1000000, 99999999);
        $upload_file_cover = $request->cover_photo;
        $extension_cover = $upload_file_cover->getClientOriginalExtension();
        $file_cover_name = $cover_name . '.' . $extension_cover;
        Image::make($upload_file_cover)->resize(300, 200)->save(public_path('uploads/about_us_photo/cover_photo/' . $file_cover_name));
            AboutUs::insert([
                'founder_name' => $request->founder_name,
                'profile_photo' => $file_profile_name,
                'cover_photo' => $file_cover_name,
                'founder_myself' => $request->founder_myself,
                'founder_journey' => $request->founder_journey,
                'created_at' => Carbon::now()

            ]);
            $notification = array(
                'message' => 'Contact Information Insert Done Successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        else {
            $privies_profile_delete=AboutUs::all()->first()->profile_photo;
            $privies_cover_delete=AboutUs::all()->first()->cover_photo;
            $category_delete_for_profile = public_path('uploads/about_us_photo/profile_photo/' .$privies_profile_delete );
            unlink($category_delete_for_profile);

            $category_delete_for_cover= public_path('uploads/about_us_photo/cover_photo/' . $privies_cover_delete );
            unlink($category_delete_for_cover);
             //profile_photo
        $profile_name = str_replace('', '-', str::lower($request->founder_name)) . '-' . rand(1000000, 99999999);
        $upload_file = $request->profile_photo;
        $extension = $upload_file->getClientOriginalExtension();
        $file_profile_name = $profile_name . '.' . $extension;
        Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/about_us_photo/profile_photo/' . $file_profile_name));

        //cover_photo
        $cover_name = str_replace('', '-', str::lower($request->founder_name)) . '-' . rand(1000000, 99999999);
        $upload_file_cover = $request->cover_photo;
        $extension_cover = $upload_file_cover->getClientOriginalExtension();
        $file_cover_name = $cover_name . '.' . $extension_cover;
        Image::make($upload_file_cover)->resize(300, 200)->save(public_path('uploads/about_us_photo/cover_photo/' . $file_cover_name));
            AboutUs::all()->first()->update([
                'founder_name' => $request->founder_name,
                'profile_photo' => $file_profile_name,
                'cover_photo' => $file_cover_name,
                'founder_myself' => $request->founder_myself,
                'founder_journey' => $request->founder_journey,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Contact Information Update Done Successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }
}
