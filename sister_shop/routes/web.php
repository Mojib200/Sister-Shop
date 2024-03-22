<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Cart_Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoponController;
use App\Http\Controllers\Customer_LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\frontendcontroller;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Sub_CategoryController;
use App\Http\Controllers\usercontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\StripePaymentController;
use Laravel\Socialite\Facades\Socialite;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// route::get('/about',function(){
//     return view('about');
// });

//ALL Route Frontend Start
//Frontend Start
 route::get('/',[frontendcontroller::class,'index'])->name('index');
 route::get('/product_detiles/{product_slug}',[frontendcontroller::class,'product_detiles'])->name('product_detiles');
 route::post('/get_size',[frontendcontroller::class,'get_size']);
 route::get('/category_product/{id}',[frontendcontroller::class,'category_product'])->name('category_product');
//  route::get('/frontend_master',[frontendcontroller::class,'frontend_master']);
//  route::get('/index',[frontendcontroller::class,'index']);

route::get('/customer_logins',[frontendcontroller::class,'customer_logins'])->name('customer_logins');
 //Frontend Stop
 //Customer Login Register Start
route::post('/customer_register_store',[CustomerRegisterController::class,'customer_register_store'])->name('customer_register_store');
route::post('/customer_login_this',[Customer_LoginController::class,'customer_login_this'])->name('customer_login_this');
route::get('/customer_logout',[Customer_LoginController::class,'customer_logout'])->name('customer_logout');
//Customer Login Register Stop
//Customer Controller Start
route::get('/customer_profile',[CustomerController::class,'customer_profile'])->name('customer_profile');
route::post('/customer_profile_update',[CustomerController::class,'customer_profile_update'])->name('customer_profile_update');
route::get('/customer_my_order_list',[CustomerController::class,'customer_my_order_list'])->name('customer_my_order_list');
route::post('/review_store',[CustomerController::class,'review_store'])->name('review_store');
//Customer Controller Stop
//Coustomer_ PassWord Reset
route::get('/customer_password_reset_request',[CustomerController::class,'customer_password_reset_request'])->name('customer_password_reset_request');
route::post('/customer_pass_reset_send_request',[CustomerController::class,'customer_pass_reset_send_request'])->name('customer_pass_reset_send_request');
route::get('/customer_pass_reset_form/{customer_token}',[CustomerController::class,'customer_pass_reset_form'])->name('customer_pass_reset_form');
route::post('/customer_pass_reset',[CustomerController::class,'customer_pass_reset'])->name('customer_pass_reset');
//Customer Email Verificaton
route::get('/customer_email_varifie_form/{customer_varifie_tokens}',[CustomerRegisterController::class,'customer_email_varifie_form'])->name('customer_email_varifie_form');
//Cart Conteroller Start
route::post('/cart_store',[Cart_Controller::class,'cart_store'])->name('cart_store');
route::get('/remove_cart/{id}',[Cart_Controller::class,'remove_cart'])->name('remove_cart');
route::get('/delete_all_cart',[Cart_Controller::class,'delete_all_cart'])->name('delete_all_cart');
route::get('/view_cart',[Cart_Controller::class,'view_cart'])->name('view_cart');
// route::get('/view_cart',[Cart_Controller::class,'view_cart'])->name('view_cart');
route::get('/remove_view/{id}',[Cart_Controller::class,'remove_view'])->name('remove_view');
route::Post('/update_cart',[Cart_Controller::class,'update_cart'])->name('update_cart');
route::get('/remove_wishlist/{id}',[Cart_Controller::class,'remove_wishlist'])->name('remove_wishlist');
route::get('/delete_all_wishlist',[Cart_Controller::class,'delete_all_wishlist'])->name('delete_all_wishlist');
route::get('/view_wishlist',[Cart_Controller::class,'view_wishlist'])->name('view_wishlist');
//Cart Conteroller Stop
//Check Out Start
route::get('/check_out',[CheckoutController::class,'check_out'])->name('check_out');
route::post('/ajax_check_city_country',[CheckoutController::class,'ajax_check_city_country']);
route::post('/order_confirm',[CheckoutController::class,'order_confirm'])->name('order_confirm');
//Check Out Stop
//Order Conmfirm Success Start
route::get('/order_confirm_success',[CheckoutController::class,'order_confirm_success'])->name('order_confirm_success');
// route::get('/404',[CheckoutController::class,'404'])->name('404');
//Order Conmfirm  Success stop

//ALL Route Frontend Stop

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/index_delete/{user_id}', [HomeController::class, 'index_delete'])->name('index_delete');
route::get('/users',[usercontroller::class,'users']);

//Start All Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');


//Start delete Restore category
Route::get('/category_delete/{id}', [CategoryController::class, 'category_delete'])->name('category_delete');
Route::get('/category_restore/{id}', [CategoryController::class, 'category_restore'])->name('category_restore');
Route::get('/category_hard_delete/{id}', [CategoryController::class, 'category_hard_delete'])->name('category_hard_delete');
//end Delete Restore


//Start edit category
Route::get('/category_edit/{id}', [CategoryController::class, 'category_edit'])->name('category_edit');
Route::post('/category_update', [CategoryController::class, 'category_update'])->name('category_update');
//end edit

//sub category
Route::get('/sub_category', [Sub_CategoryController::class, 'sub_category'])->name('sub_category');
Route::post('/sub_category_store', [Sub_CategoryController::class, 'sub_category_store'])->name('sub_category_store');
Route::get('/sub_category_delete/{id}', [Sub_CategoryController::class, 'sub_category_delete'])->name('sub_category_delete');
Route::get('/sub_category_edit/{id}', [Sub_CategoryController::class, 'sub_category_edit'])->name('sub_category_edit');
Route::post('/sub_category_update', [Sub_CategoryController::class, 'sub_category_update'])->name('sub_category_update');
//end sub category
//end All category


//Product Start
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/product_sub_category', [ProductController::class, 'product_sub_category']);
Route::post('/product_store', [ProductController::class, 'product_store'])->name('product_store');
Route::get('/product_view', [ProductController::class, 'product_view'])->name('product_view');
Route::get('/product_hard_delete/{id}', [ProductController::class, 'product_hard_delete'])->name('product_hard_delete');
Route::get('/inventory/{id}', [ProductController::class, 'inventory'])->name('inventory');
Route::get('/variation_color_size', [ProductController::class, 'variation_color_size'])->name('variation_color_size');
Route::post('/product_size', [ProductController::class, 'product_size'])->name('product_size');
Route::post('/product_color', [ProductController::class, 'product_color'])->name('product_color');
Route::post('/product_inventory', [ProductController::class, 'product_inventory'])->name('product_inventory');
Route::get('/inventory_delete/{id}', [ProductController::class, 'inventory_delete'])->name('inventory_delete');
Route::get('/color_delete/{id}', [ProductController::class, 'color_delete'])->name('color_delete');
Route::get('/size_delete/{id}', [ProductController::class, 'size_delete'])->name('size_delete');


//Brands
Route::get('/brand', [ProductController::class, 'brand'])->name('brand');
Route::post('/add_brands', [ProductController::class, 'add_brands'])->name('add_brands');
//Product Stop


//profile
Route::get('/profile', [usercontroller::class, 'profile'])->name('profile');
Route::post('/name_update', [usercontroller::class, 'name_update'])->name('name_update');
Route::post('/password_update',[usercontroller::class, 'password_update'])->name('password_update');
Route::post('/profile_photo', [usercontroller::class, 'profile_photo'])->name('profile_photo');
Route::post('/user_register', [usercontroller::class, 'user_register'])->name('user_register');
//profile

//Copon Start
route::get('/copon',[CoponController::class,'copon'])->name('copon');
route::post('/coupon_store',[CoponController::class,'coupon_store'])->name('coupon_store');
route::get('/coupon_delete/{id}',[CoponController::class,'coupon_delete'])->name('coupon_delete');
//Copon Stop
//orders_dashboard start
route::get('/orders_dashboard',[OrderController::class,'orders_dashboard'])->name('orders_dashboard');
route::post('/order_status',[OrderController::class,'order_status'])->name('order_status');
route::get('/download_invoice/{order_id}',[OrderController::class,'download_invoice'])->name('download_invoice');
//orders_dashboard stop
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
//Pay With Stripe Start
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
//Pay With Stripe Stop

//Role Start
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission', [RoleController::class, 'permission'])->name('permission');
Route::post('/role_create', [RoleController::class, 'role_create'])->name('role_create');
Route::post('/assigend_role', [RoleController::class, 'assigend_role'])->name('assigend_role');
Route::get('/remove_user_role/{id}', [RoleController::class, 'remove_user_role'])->name('remove_user_role');
Route::get('/role_edit/{id}', [RoleController::class, 'role_edit'])->name('role_edit');
Route::Post('/role_edit_update', [RoleController::class, 'role_edit_update'])->name('role_edit_update');
//Role Stop

//Coustomer_ PassWord Reset
//Search
route::get('/search',[SearchController::class,'search'])->name('search');

//socalite


Route::get('/github_redirect', [GitHubController::class, 'github_redirect'])->name('github_redirect') ;
Route::get('/github_callback', [GitHubController::class, 'github_callback'])->name('github_callback') ;

Route::get('/google_redirect', [GoogleController::class, 'google_redirect'])->name('google_redirect') ;
Route::get('/google_callback', [GoogleController::class, 'google_callback'])->name('google_callback') ;

// Route::get('/facebook_redirect', [FacebookController::class, 'facebook_redirect'])->name('facebook_redirect') ;
// Route::get('/facebook_callback', [FacebookController::class, 'facebook_callback'])->name('facebook_callback') ;



//contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact') ;
Route::post('/contact_info', [ContactController::class, 'contact_info'])->name('contact_info') ;
//Search
route::get('/contact_fontend',[ContactController::class,'contact_fontend'])->name('contact_fontend');
route::post('/customer_send_infos',[ContactController::class,'customer_send_infos'])->name('customer_send_infos');
route::get('/customer_message_delete/{id}',[ContactController::class,'customer_message_delete'])->name('customer_message_delete');

//about
Route::get('/about', [AboutUsController::class, 'about'])->name('about') ;
Route::get('/about_us_back', [AboutUsController::class, 'about_us_back'])->name('about_us_back') ;
Route::post('/founder_about_us', [AboutUsController::class, 'founder_about_us'])->name('founder_about_us') ;
