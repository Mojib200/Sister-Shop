<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Sub_CategoryController extends Controller
{
    function sub_category()
    {
        $categorys = Category::All();
        $sub_categorys = Sub_Category::All();
        return view('admin\users\category\sub_category', ['categorys' => $categorys,'sub_categorys'=>$sub_categorys]);
    }
    function sub_category_store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required',

            'sub_category_image' => 'required|file|max:5120|mimes:jpg,jpeg,png,bmp,gif,webp',


        ], [

            'category_id.required' => 'Entry this Category Id Selecte ',
            'sub_category_name.required' => 'Entry this name',
            'sub_category_image.required' => 'Entry this Image',
            'sub_category_image.image' => 'Image Formate Plz',
        ]);

        $upload_file = $request->sub_category_image;
        $extension = $upload_file->getClientOriginalExtension();
        $file_name = Auth::id() . $request->sub_category_name .'.'. $extension;
        Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/sub_category/' . $file_name));
        Sub_Category::insert([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_image' => $file_name,
            'addedby' => Auth::id(),
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'WOW finally  Sub Category Information Upload done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    function sub_category_edit($id)
    {
        $sub_categorys = Sub_Category::find($id);
        return view('admin\users\category\edit_sub_category', ['sub_categorys'=>$sub_categorys]);
    }
    function sub_category_delete($id)
    {
        $sub_category_image = Sub_Category::find($id)->sub_category_image;
        $delete = public_path('uploads/sub_category/' . $sub_category_image);
        unlink($delete);
      Sub_Category::find($id)->forceDelete();
        $notification = array(
            'message' => 'WOW finally Sub  Category Information Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }
    function sub_category_update(Request $request)
    {
        if ($request->sub_category_image == '') {
            Sub_Category::find($request->category_id)->update([
             'sub_category_name' => $request->sub_category_name,
                'addedby' => Auth::id(),
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'WOW finally Sub  Category Information Edit  done But Image same  !',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        else {
            $sub_category_image_delete = Sub_Category::where('id', $request->category_id)->first()->sub_category_image;
            $sub_category_delete_for_file = public_path('uploads/sub_category/' . $sub_category_image_delete );
            unlink($sub_category_delete_for_file);
            $upload_file = $request->sub_category_image;
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = Auth::id() . $request->sub_category_name . '.' . $extension;
            Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/sub_category/' . $file_name));
            Sub_Category::find($request->category_id)->update([
                'sub_category_name' => $request->sub_category_name,
                'addedby' => Auth::id(),
                'sub_category_image' => $file_name,
                'updated_at' => Carbon::now()

            ]);
        $notification = array(
            'message' => 'WOW finally  Category Information Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

}

}
/*ajex
function get_sub_category(Request $request){
    $sub_categorys=Sub_Category::where('category_id',$request->category_id)->get();
    $sub_cate='';
    foreach ($sub_categorys as $sub_category) {
     $sub_cate.=$sub_category->sub_category_name;
    }
    echo $sub_cate;



  }

ajex*/
