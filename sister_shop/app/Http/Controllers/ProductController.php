<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Sub_Category;
use App\Models\Thumbnail_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function product()
    {
        $categorys = Category::all();
        $brands = Brand::all();
        $sub_categorys = Sub_Category::all();
        $products = Product::All();
        return view('admin\users\product\product', ['categorys' => $categorys,'brands' => $brands, 'sub_categorys' => $sub_categorys, 'products' => $products]);
    }
    function product_store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_reguler_price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'preview' => 'required|file|max:5120|mimes:jpg,jpeg,png,bmp,gif,webp',


        ], [
            'product_name.required' => 'Entry this Product  name',
            'product_reguler_price.required' => 'Entry this Must Be Product Reguler Price ',
            'short_description.required' => 'Entry this Product  Short Description',
            'long_description.required' => 'Entry this Product long Description',
            'preview.required' => 'Entry this Product Preview',
        ]);

        $preview_name = str_replace('', '-', Str::lower($request->product_name)) . '-' . rand(1000000, 99999999);
        $preview_load = $request->preview;
        $extension = $preview_load->getClientOriginalExtension();
        $preview_new_name = $preview_name . '.' . $extension;
        Image::make($preview_load)->resize(300, 200)->save(public_path('uploads/product_photo/preview/' . $preview_new_name));

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_reguler_price' => $request->product_reguler_price,
            'product_discount_price' => $request->product_discount_price,
            'product_after_discount_price' => ($request->product_reguler_price - ($request->product_reguler_price * $request->product_discount_price) / 100),
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'preview' => $preview_new_name,
            'product_slug' => str_replace('', '-', Str::lower($request->product_name)) . '-' . rand(1000000, 99999999),
            'brand' => $request->brand,
            'created_at' => Carbon::now(),
        ]);

        $thumbnail_loads = $request->thumbnails;
        foreach ($thumbnail_loads as $thumbnail_load) {
            $thumbnail_name = str_replace('', '-', Str::lower($request->product_name)) . '-' . rand(1000000, 99999999);
            $extension = $thumbnail_load->getClientOriginalExtension();
            echo $extension;
            $thumbnail_new_name = $thumbnail_name . '.' . $extension;
            echo $thumbnail_new_name;
            Image::make($thumbnail_load)->resize(300, 200)->save(public_path('uploads/product_photo/thumbnail/' . $thumbnail_new_name));

            Thumbnail_Image::insert([
                'product_id' => $product_id,
                'thumbnails' => $thumbnail_new_name,
                'created_at' => Carbon::now(),
            ]);
        }


        $notification = array(
            'message' => 'WOW finally  Product Information Insert  done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    // start javascript
    function product_sub_category(Request $request)
    {
        $subcategories = Sub_Category::where('category_id', $request->category_id)->get();
        $str_to_send = '<option>-- Select subcategory --</option>';
        foreach ($subcategories as $subcategory) {
            $str_to_send .= '<option value="' . $subcategory->id . '">' . $subcategory->sub_category_name . '</option>';
        }
        echo $str_to_send;
    }
    // start javascript

    function product_view()
    {
        $products = Product::all();
        return view('admin\users\product\view_product', ['products' => $products]);
    }

    function product_hard_delete($id)
    {
        $preview = Product::find($id)->preview;
        $delete = public_path('/uploads/product_photo/preview/' .  $preview);
        unlink($delete);
        Product::find($id)->Delete();
        $notification = array(
            'message' => 'WOW finally Product  Information Delete done !',
            'alert-type' => 'success'
        );

        // $thumbs = Thumbnail_Image::where('product_id', $product_id)->get();
        // foreach ($thumbs as $thumb) {
        //     $delete_thumb_from = public_path('uploads/product/thumbnail/' . $thumb->thumbnail);
        //     unlink($delete_thumb_from);
        //     Thumbnail_Image::find($thumb->id)->delete();
        // }

        // $inventories = Inventory::where('product_id', $product_id)->get();
        // foreach ($inventories as $inventory) {
        //     Inventory::find($inventory->id)->delete();
        // }
        return back()->with($notification);
    }


    //inventory Start
    function inventory($product_id)
    {
        $product_information = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventorys = Inventory::where('product_id', $product_id)->get();
        return view('admin\users\product\inventory', ['product_information' => $product_information, 'sizes' => $sizes, 'colors' => $colors, 'inventorys' => $inventorys]);
    }
    function inventory_delete($id)
    {

        Inventory::find($id)->delete();
        $notification = array(
            'message' => 'WOW finally  Inventory Information Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    function product_inventory(Request $request)
    {
        if(Inventory::where('product_id', $request->product_id)->where( 'color_id', $request->color_id)->where(  'size_id', $request->size_id)->exists()){
            Inventory::where(  'product_id', $request->product_id)->where(  'color_id', $request->color_id)->where(  'size_id', $request->size_id)->increment('quantity', $request->quantity);
            $notification = array(
                'message' => 'WOW finally Product Quantity Increment  done !',
                'alert-type' => 'success'
            );
            return back()->with($notification);

        }
       else{
        Inventory::insert([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'WOW finally Product Color Insert  done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);

       }


    }
    //inventory Stop

    //variation Start
    function variation_color_size()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin\users\product\variation_color_size', ['sizes' => $sizes, 'colors' => $colors]);
    }
    function product_size(Request $request)
    {
        Size::insert([

            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'WOW finally Product  Size Insert done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    function size_delete($id)
    {

        Size::find($id)->delete();
        $notification = array(
            'message' => 'WOW finally  Color Information Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    function product_color(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'WOW finally Product Color Insert  done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    function color_delete($id)
    {

        Color::find($id)->delete();
        $notification = array(
            'message' => 'WOW finally  Color Information Delete done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    //variation Stop

    //brand
    function brand(){
        $all_info_brands=Brand::all();
        return view('admin\users\product\brand',['all_info_brands'=>$all_info_brands,]);
    }

    function add_brands(Request $request){
      if($request->brand_logo==''){
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'created_at'=>now(),

        ]);
        $notification = array(
            'message' => 'Brand Name Insert  done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);
      }
      else {
        $brand_logo_load = $request->brand_logo;
        $extension = $brand_logo_load->getClientOriginalExtension();
        $brand_new_name = $request->brand_name . '.' . $extension;
        Image::make($brand_logo_load)->resize(300, 200)->save(public_path('uploads/brand/' . $brand_new_name));
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_logo'=>$brand_new_name,
            'created_at'=>now(),

        ]);
        $notification = array(
            'message' => 'Brand Name and Logo Insert  done !',
            'alert-type' => 'success'
        );
        return back()->with($notification);

      };
    }
}
