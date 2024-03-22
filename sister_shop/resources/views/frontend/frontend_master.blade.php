<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Themezhub" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kumo- Fashion eCommerce HTML Template</title>


    <!-- Custom CSS -->
    <link href="{{ asset('frontend/css/plugins/animation.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/iconfont.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/ion.rangeSlider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/light-box.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/snackbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/plugins/themify.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet">
    {{-- Search --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Search --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>



    <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/65cae22d0ff6374032cc6785/1hmg8714s';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->







    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader"></div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- Top Header -->
        <div class="py-2 br-bottom">
            <div class="container">
                <div class="row">
                    @php
                    $contact_info = App\Models\Contact::all()->first();
                    @endphp

                    <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 hide-ipad">
                        <div class="top_second">
                            <p class="medium text-muted m-0 p-0"><i class="lni lni-phone fs-sm"></i></i> Hotline <a
                                    href="#" class="medium text-dark text-underline">0{{$contact_info->company_number}}</a></p>
                        </div>
                    </div>


                    <!-- Right Menu -->
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                        <!-- Choose Language -->
                        <div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">

                        </div>

                        <div class="currency-selector dropdown js-dropdown float-right mr-3">
                            @if (session('message'))
                                <h6 class="alert alert-info text-center bg-success text-white">
                                    {{ session('message') }}
                                </h6>
                            @endif
                            @if (session('message_1'))
                                <h6 class="alert alert-info text-center bg-danger text-white">
                                    {{ session('message_1') }}
                                </h6>
                            @endif


                            @auth('customer_logins')
                                @if (Auth::guard('customer_logins')->user()->email_varifie != null)
                                    <div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">
                                        <div>
                                            <a class="popup-title"href="javascript:void(0)" role="button"
                                                data-toggle="dropdown">


                                                @if (Auth::guard('customer_logins')->user()->customer_photo == null)
                                                    <img src="{{ Avatar::create(Auth::guard('customer_logins')->user()->customer_name)->toBase64() }} "
                                                        width="30" />
                                                @else
                                                    <img src="{{ asset('/uploads/customer_photo') }}/{{ Auth::guard('customer_logins')->user()->customer_photo }}"
                                                        width="80" height="80" class="rounded-circle"
                                                        alt="" />
                                                @endif
                                            </a>
                                        </div>
                                        <div><span
                                                class="fs-12 mb-0">{{ Auth::guard('customer_logins')->user()->email }}</span>
                                            <br>
                                        </div>
                                        <div>
                                            <a class="popup-title" href="javascript:void(0)" data-toggle="dropdown"
                                                title="Language" aria-label="Language dropdown">
                                                <span
                                                    class="iso_code medium text-muted">{{ Auth::guard('customer_logins')->user()->customer_name }}</span>
                                                <i class="fa fa-angle-down medium text-muted"></i>
                                            </a>
                                            <ul class="dropdown-menu popup-content link">
                                                <li class="current">
                                                    <a href="{{ route('customer_profile') }}"
                                                        class="dropdown-item medium text-muted"><span>Profile</span></a>
                                                </li>
                                                <li> <a class="dropdown-item ai-icon"
                                                        href="{{ route('customer_logout') }}">
                                                        <span>Logout</span>
                                                    </a>
                                                    {{-- <li> <a class="dropdown-item ai-icon" href="{{ route('customer_logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                                <span>Logout</span>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                      </li> --}}
                                                </li>
                                            </ul>
                                        </div>

                                        <ul class="dropdown-menu popup-content link">
                                            <li class="nav-item dropdown header-profile">

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item ai-icon">
                                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg"
                                                            class="text-primary" width="18" height="18"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                            <circle cx="12" cy="7" r="4"></circle>
                                                        </svg>
                                                        <span class="ml-2">Profile </span>
                                                    </a>
                                                    <a href="./email-inbox.html" class="dropdown-item ai-icon">
                                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg"
                                                            class="text-success" width="18" height="18"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                            </path>
                                                            <polyline points="22,6 12,13 2,6"></polyline>
                                                        </svg>
                                                        <span class="ml-2">Inbox </span>
                                                    </a>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- @else
                                    <a href="{{ route('customer_logins') }}" class="text-muted medium"><i
                                            class="lni lni-user mr-1"></i>Sign In / Register</a> --}}
                                @endif
                            @else
                                <a href="{{ route('customer_logins') }}" class="text-muted medium"><i
                                        class="lni lni-user mr-1"></i>Sign In / Register</a>
                            @endauth

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="headd-sty header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="headd-sty-wrap d-flex align-items-center justify-content-between py-3">
                            <div class="headd-sty-left d-flex align-items-center">
                                <div class="headd-sty-01">
                                    <a class="nav-brand py-0" href="#">
                                        <img src="https://i.postimg.cc/g2s2g877/260px-svg.png" class="logo"
                                            alt="" height="60" width="60" />
                                    </a>
                                </div>
                                <div class="headd-sty-02 ml-3">
                                    <div class="input-group bg-white rounded-md border-bold">
                                        <input type="text" id="search_id" class="form-control custom-height b-0"
                                            placeholder="Search for products..." value="{{ @$_GET['q'] }}" />
                                        <div class="input-group-append">
                                            <div class="input-group-text"><button
                                                    class="btn bg-white text-danger custom-height rounded px-3"
                                                    type="button" id="search_button"><i
                                                        class="fas fa-search"></i></button></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="headd-sty-last">
                                <ul class="nav-menu nav-menu-social align-to-right align-items-center d-flex">
                                    <li>
                                        <div class="call d-flex align-items-center text-left">
                                            <i class="lni lni-phone fs-xl"></i>
                                            <span class="text-muted small ml-3">Call Us Now:<strong
                                                    class="d-block text-dark fs-md">0{{$contact_info->company_number}}</strong></span>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openWishlist()">
                                            <i class="far fa-heart fs-lg"></i><span
                                                class="dn-counter bg-success">{{ App\Models\Wishlist::where('customer_id', Auth::guard('customer_logins')->id())->count() }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openCart()">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <i class="fas fa-shopping-basket fs-lg"></i><span
                                                    class="dn-counter theme-bg">{{ App\Models\Cart::where('customer_id', Auth::guard('customer_logins')->id())->count() }}</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile_nav">
                                <ul>
                                    <li>
                                        <a href="#" onclick="openSearch()">
                                            <i class="lni lni-search-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#login">
                                            <i class="lni lni-user"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openWishlist()">
                                            <i class="lni lni-heart"></i><span class="dn-counter">2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="openCart()">
                                            <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Navigation -->
        <div class="headerd header-dark head-style-2">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <div class="nav-toggle"></div>
                        <div class="nav-menus-wrapper">
                            <ul class="nav-menu">
                                <li><a href="{{ route('index') }}" class="pl-0">Home</a></li>
                                <li><a href="{{ route('about') }}">Shop</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact_fontend') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->

        <!-- ======================= Category & Slider ======================== -->

        @yield('content')
        <!-- ======================= Customer Features ======================== -->
        <section class="px-0 py-3 br-top">
            <div class="container">
                <div class="row">

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">Free Shipping</h5>
                                <span class="text-muted">Capped at $10 per order</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="far fa-credit-card"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">Secure Payments</h5>
                                <span class="text-muted">Up to 6 months installments</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">15-Days Returns</h5>
                                <span class="text-muted">Shop with fully confidence</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="d-flex align-items-center justify-content-start py-2">
                            <div class="d_ico">
                                <i class="fas fa-headphones-alt"></i>
                            </div>
                            <div class="d_capt">
                                <h5 class="mb-0">24x7 Fully Support</h5>
                                <span class="text-muted">Get friendly support</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======================= Customer Features ======================== -->

        <!-- ============================ Footer Start ================================== -->
        <footer class="dark-footer skin-dark-footer style-2">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <img src="https://i.postimg.cc/g2s2g877/260px-svg.png" width="200" height="80" class="img-footer small mb-2"
                                    alt="" />

                                <div class="address mt-3">
                                    {{$contact_info->company_location}}
                                </div>
                                <div class="address mt-3">
                                    0{{$contact_info->company_number}}<br>{{$contact_info->company_email}}
                                </div>
                                <div class="address mt-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="{{$contact_info->company_facebook}}"><i
                                                    class="lni lni-facebook-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="{{$contact_info->company_youtube}}"><i
                                                    class="lni lni-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="{{$contact_info->company_instagram}}"><i
                                                    class="lni lni-instagram-filled"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Supports</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">About Page</a></li>
                                    <li><a href="#">Size Guide</a></li>
                                    <li><a href="#">FAQ's Page</a></li>
                                    <li><a href="#">Privacy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Shop</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Men's Shopping</a></li>
                                    <li><a href="#">Women's Shopping</a></li>
                                    <li><a href="#">Kids's Shopping</a></li>
                                    <li><a href="#">Furniture</a></li>
                                    <li><a href="#">Discounts</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Company</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                    <li><a href="#">Login</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Subscribe</h4>
                                <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                                <div class="foot-news-last">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email Address">
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text b-0 text-light"><i
                                                    class="lni lni-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="address mt-3">
                                    <h5 class="fs-sm text-light">Secure Payments</h5>
                                    <div class="scr_payment"><img src="{{ asset('frontend/img/card.png') }}"
                                            class="img-fluid" alt="" /></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 text-center">
                            <p class="mb-0">© 2021 Kumo. Designd By <a href="https://themezhub.com/">ThemezHub</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ================================== -->

        <!-- Wishlist -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;"
            id="Wishlist">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
                    @if (App\Models\Wishlist::where('customer_id', Auth::guard('customer_logins')->id())->count() != 0)
                        <div>
                            <a href="{{ route('delete_all_wishlist') }}" class="btn btn-danger btn-sm text-white">All
                                Clean Wishlist</a>
                        </div>
                    @endif
                    <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                @if (App\Models\Wishlist::where('customer_id', Auth::guard('customer_logins')->id())->count() == 0)
                    <div class="mt-3 bg- text-success text-center"> Wishlist Empty</div>
                @else
                    <div class="right-ch-sideBar">

                        <div class="cart_select_items py-2">
                            <!-- Single Item -->
                            @php
                                $subtotal = 0;
                            @endphp


                            @foreach (App\Models\Wishlist::where('customer_id', Auth::guard('customer_logins')->id())->get() as $wish_info)
                                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                    <div class="cart_single d-flex align-items-center">
                                        <div class="cart_selected_single_thumb">
                                            <a href="#"><img
                                                    src="{{ asset('uploads/product_photo/preview') }}/{{ $wish_info->relation_to_product_info->preview }}"
                                                    width="60" class="img-fluid" alt="" /></a>
                                        </div>
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">
                                                {{ $wish_info->relation_to_product_info->product_name }}</h4>
                                            <p class="mb-2"><span class="text-dark ft-medium small">
                                                    @if ($wish_info->size_id == null)
                                                        <p class="mb-2"><span class="text-dark ft-medium small"> No
                                                                Size ,</span>
                                                        @else
                                                            <b class="mb-2"><span
                                                                    class="text-dark ft-medium small text-danger">{{ $wish_info->relation_to_size_info->size_name }},</span>
                                                    @endif
                                                    @if ($wish_info->color_id == null)
                                                        <span class="text-dark small"> No Color</span>
                                            </p>
                                        @else
                                            <span
                                                class="text-dark small text-danger">{{ $wish_info->relation_to_color_info->color_name }}</span>
                                            </b>
                            @endif
                            <h4 class="fs-md ft-medium mb-0 lh-1">
                                TK-{{ $wish_info->relation_to_product_info->product_after_discount_price }} X
                                {{ $wish_info->quantity }}</h4>
                        </div>
                    </div>
                    <div class="fls_last">
                        <a href="{{ route('remove_wishlist', $wish_info->id) }}" class="close_slide gray"><i
                                class="ti-close"></i></a>
                    </div>
            </div>
            @endforeach
            <!-- Single Item -->

        </div>

        <div class="cart_action px-3 py-3">
            <div class="form-group">
                <a href="{{ route('view_wishlist') }}" class="btn d-block full-width btn-dark-light">View
                    Whishlist</a>
            </div>
        </div>

    </div>
    @endif
    </div>
    </div>

    <!-- Cart -->
    <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
        <div class="rightMenu-scroll">
            <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                <h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
                @if (App\Models\Cart::where('customer_id', Auth::guard('customer_logins')->id())->count() != 0)
                    <div>
                        <a href="{{ route('delete_all_cart') }}" class="btn btn-danger btn-sm text-white">All Clean
                            Cart</a>
                    </div>
                @endif

                <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>

            </div>
            @if (App\Models\Cart::where('customer_id', Auth::guard('customer_logins')->id())->count() == 0)
                <div class="mt-3 bg- text-success text-center"> Cart Empty</div>
            @else
                <div class="right-ch-sideBar">

                    <div class="cart_select_items py-2">
                        <!-- Single Item -->
                        @php
                            $subtotal = 0;
                        @endphp


                        @foreach (App\Models\Cart::where('customer_id', Auth::guard('customer_logins')->id())->get() as $cart_info)
                            <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                <div class="cart_single d-flex align-items-center">
                                    <div class="cart_selected_single_thumb">
                                        <a href="#"><img
                                                src="{{ asset('uploads/product_photo/preview') }}/{{ $cart_info->relation_to_product_info->preview }}"
                                                width="60" class="img-fluid" alt="" /></a>
                                    </div>
                                    <div class="cart_single_caption pl-2">

                                        <h4 class="product_title fs-sm ft-medium mb-0 lh-1">
                                            {{ $cart_info->relation_to_product_info->product_name }}
                                        </h4>
                                        @if ($cart_info->size_id == null)
                                            <p class="mb-2"><span class="text-dark ft-medium small"> No Size
                                                    ,</span>
                                            @else
                                                <b class="mb-2"><span
                                                        class="text-dark ft-medium small text-danger">{{ $cart_info->relation_to_size_info->size_name }},</span>
                                        @endif
                                        @if ($cart_info->color_id == null)
                                            <span class="text-dark small"> No Color</span>
                                            </p>
                                        @else
                                            <span
                                                class="text-dark small text-danger">{{ $cart_info->relation_to_color_info->color_name }}</span>
                                            </b>
                                        @endif


                                        <h4 class="fs-md ft-medium mb-0 lh-1">
                                            TK-{{ $cart_info->relation_to_product_info->product_after_discount_price }}
                                            X {{ $cart_info->quantity }}
                                        </h4>

                                    </div>
                                </div>
                                <div class="fls_last"><a href="{{ route('remove_cart', $cart_info->id) }}"
                                        class="close_slide gray"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            @php
                                $subtotal = $subtotal + $cart_info->relation_to_product_info->product_after_discount_price * $cart_info->quantity;

                            @endphp
                        @endforeach
                    </div>

                    <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                        <h6 class="mb-0">Subtotal</h6>
                        <h3 class="mb-0 ft-medium">Tk- {{ $subtotal }}</h3>
                    </div>

                    <div class="cart_action px-3 py-3">
                        <div class="form-group">
                            <a href="{{ route('view_cart') }}" class="btn d-block full-width btn-dark-light">View
                                Cart</a>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>

    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.js') }}"></script>
    <script src="{{ asset('frontend/js/slider-bg.js') }}"></script>
    <script src="{{ asset('frontend/js/lightbox.js') }}"></script>
    <script src="{{ asset('frontend/js/smoothproducts.js') }}"></script>
    <script src="{{ asset('frontend/js/snackbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jQuery.style.switcher.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    {{-- Search --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <script>
        function openWishlist() {
            document.getElementById("Wishlist").style.display = "block";
        }

        function closeWishlist() {
            document.getElementById("Wishlist").style.display = "none";
        }
    </script>

    <script>
        function openCart() {
            document.getElementById("Cart").style.display = "block";
        }

        function closeCart() {
            document.getElementById("Cart").style.display = "none";
        }
    </script>

    <script>
        function openSearch() {
            document.getElementById("Search").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("Search").style.display = "none";
        }
    </script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {

                case 'info':
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    @yield('footer_script')

    @if (session('success_login'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Successfully"
            });
        </script>
    @endif
    <script>
        $('#search_button').click(function() {
            var search_id = $('#search_id').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_id"]:checked').attr('value');
            var size_id = $('input[class="size_id"]:checked').attr('value');
            var all_sorttings=$('.all_sortting').val();
            var brands= $('input[class="brand"]:checked').attr('value');
            var link = "{{ route('search') }}" + "?q=" + search_id + "&min=" + min + "&max=" + max +
                "&category_id=" + category_id + "&color_id=" + color_id + "&size_id=" + size_id+"&all_sorttings="+all_sorttings+"&brands="+brands;
            window.location.href = link;

        })
        $('#price_button').click(function() {
            var search_id = $('#search_id').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var link = "{{ route('search') }}" + "?q=" + search_id + "&min=" + min + "&max=" + max;
            window.location.href = link;

        })
    </script>
</body>

</html>
