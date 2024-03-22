<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Inventory;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Thumbnail_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class frontendcontroller extends Controller
{
    // function home()
    // {
    //    return view('welcome');
    // }
    // function frontend_master()
    // {
    //    return view('frontend\frontend_master');
    // }
    function index()
    {
        $categorys = Category::all();

        $products = Product::all();
        $customer_review = OrderProduct::all()->groupBy('customer_id')->first();
        $cart_info = Cart::where('customer_id', Auth::guard('customer_logins')->id())->get();
        $top_seller = OrderProduct::groupBy('product_id')
            ->selectRaw('sum(quantity)as sum, product_id')
            ->havingRaw('sum >= 5')
            ->take(5)
            ->orderBy('sum', 'DESC')
            ->get();
        // $top_seller_star=OrderProduct::groupBy('product_id')
        // ->selectRaw('avg(star)as avg, product_id')
        // ->get();
        // return  $top_seller_star;
        // die();
        // $products=Product::latest()->take(12)->get();

        //cookie
        $recent_view_product=json_decode(Cookie::get('recent_view'), true);

        if ($recent_view_product == NULL) {
            $recent_view_product = [];
            $after_unique = array_unique($recent_view_product);
        } else {
            $after_unique = array_reverse(array_unique($recent_view_product));
        }
        $recent_view_product = Product::find($after_unique)->take(20);

        $featured_products = Product::latest()->take(5)->get();
        return view('frontend\index', [
            'categorys' => $categorys, 'products' => $products,
            'featured_products' => $featured_products,
            'cart_info' => $cart_info,
            'top_seller' => $top_seller,
            'recent_view_product' => $recent_view_product,
            'customer_review' => $customer_review,

            // 'top_seller_star' => $top_seller_star,
        ]);
    }
    function product_detiles($product_slug)
    {
        $product_detalis = Product::where('product_slug', $product_slug)->get();
        // jokhon $category_name nite hobe tokhon ei code tuku use korle hobe ar na hoi releation ta use korbo
        // $category_name=Product::where('product_id',$product_detalis->first()->category_id)->first()->category_name;

        $thumbnails = Thumbnail_Image::where('product_id', $product_detalis->first()->id)->get();
        $related_product = Product::where('category_id', $product_detalis->first()->category_id)->where('id', '!=', $product_detalis->first()->id)->get();
        $colors = Inventory::where('product_id', $product_detalis->first()->id)->groupBy('color_id')->selectRaw('count(*) as total,color_id')->get();
        $size_availables = Inventory::where('product_id', $product_detalis->first()->id)->first()->size_id;
        $sizes = Size::all();
        $review_infos = OrderProduct::where('product_id', $product_detalis->first()->id)->where('review', '!=', null)->get();
        $total_review = OrderProduct::where('product_id', $product_detalis->first()->id)->where('review', '!=', null)->count();
        $total_star = OrderProduct::where('product_id', $product_detalis->first()->id)->where('review', '!=', null)->sum('star');

        //recent view
        $product_id = $product_detalis->first()->id;
        $all = Cookie::get('recent_view');
        if (!$all) {
            $all = "[]";
        }
        $all_info = json_decode($all, true);
        $all_info = Arr::prepend($all_info, $product_id);
        $recent_product_id = json_encode($all_info);
        Cookie::queue('recent_view', $recent_product_id, 1000);
        return view(
            'frontend\product_detiles',
            [
                'product_detalis' => $product_detalis,
                'thumbnails' => $thumbnails,
                'colors' => $colors,
                'related_product' => $related_product,
                'sizes' => $sizes,
                'size_availables' => $size_availables,
                'review_infos' => $review_infos,
                'total_review' => $total_review,
                'total_star' => $total_star,

            ]
        );
    }

    function get_size(Request $request)
    {
        $get_sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        $str = '';
        foreach ($get_sizes as $size) {
            $str .= '<div class="form-check form-option size-option  form-check-inline mb-2">
     <input class="form-check-input" value="' . $size->relation_to_size->id . '" type="radio"
         name="size_id" id="size' . $size->relation_to_size->id . '">
     <label class="form-option-label"
         for="size' . $size->relation_to_size->id . '"> ' . $size->relation_to_size->size_name . ' </label>
 </div>';
        }
        echo $str;
    }

    //Customer Login Register start
    function customer_logins()
    {
        return view('frontend\customer_login');
    }
    //Customer Login Register Stop
    function category_product($id){
        $category_info=Category::find($id);
        $category_product_info=Product::where('category_id',$id)->get();
        return view('frontend\category_product_view',['category_info'=>$category_info,'category_product_info'=>$category_product_info]);

    }

}
