<?php

namespace App\Http\Controllers;


use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function category()
    {
        $categorys = Category::all();
        $soft_delete = Category::onlyTrashed()->get();
        return view('admin\users\category\category', ['categorys' => $categorys, 'trashed' => $soft_delete]);
    }
    /// insert Code
    public function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
            'category_image' => 'required|file|max:5120|mimes:jpg,jpeg,png,bmp,gif,webp',


        ], [
            'category_name.required' => 'Entry this name',
            'category_image.required' => 'Entry this Image',
            'category_image.image' => 'Image Formate Plz',
        ]);
        // if ($request->hasFile('category_image')) {
        //     $manager = new ImageManager(new Driver());
        //     $new_name = $request->category_name . "." . $request->file('category_image')->getClientOriginalExtension();
        //     $img = $manager->read($request->File('category_image'));
        //     $img->tojpeg(80)->save(base_path('public/uploads/category_image/'.$new_name));
        $upload_file = $request->category_image;
        $extension = $upload_file->getClientOriginalExtension();
        $file_name = Auth::id() . $request->category_name . '.' . $extension;
        Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/category_image/' . $file_name));
        Category::insert([
            'category_name' => $request->category_name,
            'addedby' => auth::id(),
            'category_image' => $file_name,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'WOW finally  Category Information Upload done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);


        // return back()->with('category_success', 'WOW finally  Category Information Upload done');
    }
    //end insert code
    //Start Delete code
    public function category_delete($id)
    {
        Category::find($id)->delete();
        $notification = array(
            'message' => 'WOW finally  Category Information Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
        // return back()->with('delete_success', 'WOW finally  Category Information Delete done');
    }
    public function category_restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        $notification = array(
            'message' => 'WOW finally  Category Information Restore done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    public function category_hard_delete($id)
    {
        $category_image = Category::onlyTrashed()->where('id', $id)->first()->category_image;

        $delete = public_path('uploads/category_image/' . $category_image);
        unlink($delete);
        Category::onlyTrashed()->find($id)->forceDelete();
        $notification = array(
            'message' => 'WOW finally  Category Information Hard Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    //End Delete Code

    //Start Edit Code
    public function category_edit($id)
    {
        $category_information = Category::find($id);
        return view('admin\users\category\edit', ['category_information' => $category_information,]);
    }
    public function category_update(Request $request)
    {
        if ($request->category_image == '') {
            Category::find($request->category_id)->update([
             'category_name' => $request->category_name,
                'addedby' => Auth::id(),
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'WOW finally  Category Information Edit  done But Image same  !',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        else {
            $category_image_delete = Category::where('id', $request->category_id)->first()->category_image;
            $category_delete_for_file = public_path('uploads/category_image/' . $category_image_delete );
            unlink($category_delete_for_file);
            $upload_file = $request->category_image;
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = Auth::id() . $request->category_name . '.' . $extension;
            Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/category_image/' . $file_name));
            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'addedby' => Auth::id(),
                'category_image' => $file_name,
                'updated_at' => Carbon::now()

            ]);
            $notification = array(
                'message' => 'WOW finally  Category Information Edit  done and Image New Upload !',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }

    }
}
