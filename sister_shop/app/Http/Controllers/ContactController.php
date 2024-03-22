<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer_Send_Info;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function contact(){

        $contact_information=Contact::all()->first();
        $customer_message=Customer_Send_Info::all();
        return view('admin\users\contact\contact',['contact_information'=> $contact_information,'customer_message'=>$customer_message]);
    }
    function contact_fontend(){
        $contact_infor=Contact::all()->first();
        return view('frontend\contact_frontend',['contact_infor'=> $contact_infor]);
    }

    function contact_info(Request $request){
        if(Contact::all()=='[]'){
            Contact::insert([
            'company_email'=>$request->company_email,
            'company_number'=>$request->company_number,
            'company_location'=>$request->company_location,
            'company_facebook'=>$request->company_facebook,
            'company_youtube'=>$request->company_youtube,
            'company_instagram'=>$request->company_instagram,
            'created_at' => Carbon::now()

        ]);
        $notification = array(
            'message' => 'Contact Information Insert Done Successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
        else {
            Contact::all()->first()->update([
                'company_email'=>$request->company_email,
                'company_number'=>$request->company_number,
                'company_location'=>$request->company_location,
                'company_facebook'=>$request->company_facebook,
                'company_youtube'=>$request->company_youtube,
                'company_instagram'=>$request->company_instagram,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Contact Information Update Done Successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }

    }

    function customer_send_infos(Request $request){
        Customer_Send_Info::insert([
            'customer_name'=>$request->customer_name,
            'customer_email'=>$request->customer_email,
            'customer_number'=>$request->customer_number,
            'customer_subject'=>$request->customer_subject,
            'customer_message'=>$request->customer_message,
            'created_at'=>Carbon::now()

        ]);
        $notification = array(
            'message' => 'Your Message Send Successfully Done.Waiting For Reply Meassage Check Your Email!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    function customer_message_delete($id){
        Customer_Send_Info::find($id)->delete();
        $notification = array(
            'message' => 'Fake Information So Delete',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
