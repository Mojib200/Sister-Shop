@extends('frontend.frontend_master')

@section('content')
    <section class="p-0">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="killore-new-block-link border mb-3 mt-3">
                        <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>

                        <div class="killore--block-link-content">
                            <ul>
                                @foreach ($categorys as $category)
                                    <li><a href="{{route('category_product',$category->id)}}"><img
                                                src="{{ asset('uploads/category_image') }}/{{ $category->category_image }}"
                                                width="40" height="40" alt="">
                                            {{ $category->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                    <div class="home-slider auto-slider mb-3 mt-3">

                        <!-- Slide -->
                        <div data-background-image="{{ asset('frontend/img/light-banner-1.png') }}" class="item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="home-slider-container">

                                            <!-- Slide Title -->
                                            <div class="home-slider-desc">
                                                <div class="home-slider-title mb-4">
                                                    <h5 class="fs-sm ft-ragular mb-2">New Collection</h5>
                                                    <h1 class="mb-2 ft-bold">The Standard<br>With <span
                                                            class="theme-cl">Smartness</span></h1>
                                                    <span class="trending">Apple 10 comes with 6.5 inches full HD + High
                                                        Valume</span>
                                                </div>

                                                <a href="#" class="btn btn-white stretched-link hover-black">Buy Now<i
                                                        class="lni lni-arrow-right ml-2"></i></a>
                                            </div>
                                            <!-- Slide Title / End -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide -->
                        <div data-background-image="{{ asset('frontend/img/light-banner-2.png') }}" class="item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="home-slider-container">

                                            <!-- Slide Title -->
                                            <div class="home-slider-desc">
                                                <div class="home-slider-title mb-4">
                                                    <h5 class="fs-sm ft-ragular mb-2">Super Sale</h5>
                                                    <h1 class="mb-2 ft-bold">The Standard<br>With <span
                                                            class="text-success">Smartness</span></h1>
                                                    <span class="trending">Xiomi Redmi 10 comes with 6.5 inches full HD +
                                                        LCD Screen</span>
                                                </div>

                                                <a href="#" class="btn btn-white stretched-link hover-black">Shop
                                                    Now<i class="lni lni-arrow-right ml-2"></i></a>
                                            </div>
                                            <!-- Slide Title / End -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide -->
                        <div data-background-image="{{ asset('frontend/img/light-banner-3.png') }}" class="item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="home-slider-container">

                                            <!-- Slide Title -->
                                            <div class="home-slider-desc">
                                                <div class="home-slider-title mb-4">
                                                    <h5 class="fs-sm ft-ragular mb-2">Super Sale</h5>
                                                    <h1 class="mb-2 ft-bold">The Standard<br>With Smartness</h1>
                                                    <span class="trending">Xiomi Redmi 10 comes with 6.5 inches full HD +
                                                        LCD Screen</span>
                                                </div>

                                                <a href="#" class="btn theme-bg text-light">Shop Now<i
                                                        class="lni lni-arrow-right ml-2"></i></a>
                                            </div>
                                            <!-- Slide Title / End -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Category & Slider ======================== -->

    <!-- ======================= Product List ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Trendy Products</h2>
                        <h3 class="ft-bold pt-3">Our Trending Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center rows-products">
                <!-- Single -->
                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">

                                @if ($product->product_discount_price)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper"> -{{ $product->product_discount_price }}%
                                </div>@endif

                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="{{route('product_detiles',$product->product_slug)}}"><img
                                            src="{{ asset('uploads/product_photo/preview') }}/{{ $product->preview }}"
                                            width="280" height="280" alt=""></a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                <div class="text-left">
                                    <div class="text-left">
                                        <div class="elso_titl"><span
                                                class="small">{{ $product->relation_to_sub_category->sub_category_name }}</span>
                                        </div>
                                        <h5 class="fs-md mb-0 lh-1 mb-1"><a
                                                href="{{route('product_detiles',$product->product_slug)}}">{{ $product->product_name }}</a>
                                        </h5>
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="elis_rty"><span class="ft-bold text-dark fs-sm">
                                                @if ($product->product_discount_price)
                                                    <span
                                                        class="ft-medium text-muted line-through fs-md mr-2">TK-{{ $product->product_reguler_price }}</span>
                                                @endif TK-{{ $product->product_after_discount_price }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="position-relative text-center">
                        <a href="shop-style-1.html" class="btn stretched-link borders">Explore More<i
                                class="lni lni-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ======================= Product List ======================== -->

    <!-- ======================= Brand Start ============================ -->
    <section class="py-3 br-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="smart-brand">

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-1.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-2.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-3.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-4.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-5.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-6.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-1.png') }}" class="img-fluid" alt="" />
                        </div>

                        <div class="single-brnads">
                            <img src="{{ asset('frontend/img/shop-logo-2.png') }}" class="img-fluid" alt="" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Brand Start ============================ -->

    <!-- ======================= Tag Wrap Start ============================ -->
    <section class="bg-cover" style="background:url({{ asset('frontend/img/e-middle-banner.png') }}) no-repeat;">
        <div class="ht-60"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="tags_explore text-center">
                        <h2 class="mb-0 text-white ft-bold">Big Sale Up To 70% Off</h2>
                        <p class="text-light fs-lg mb-4">Exclussive Offers For Limited Time</p>
                        <p>
                            <a href="#" class="btn btn-lg bg-white px-5 text-dark ft-medium">Explore Your Order</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ht-60"></div>
    </section>
    <!-- ======================= Tag Wrap Start ============================ -->

    <!-- ======================= All Category ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Popular Categories</h2>
                        <h3 class="ft-bold pt-3">Trending Categories</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">


                @foreach ($categorys as $category)
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                        <div class="cats_side_wrap text-center mx-auto mb-3">
                            <div class="sl_cat_01">
                                <div
                                    class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border">
                                    <a href="{{route('category_product',$category->id)}}" class="d-block"><img
                                            src="{{ asset('uploads/category_image') }}/{{ $category->category_image }}"
                                            width="50" height="50" alt=""></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a
                                        href="{{route('category_product',$category->id)}}">{{ $category->category_name }}</a></h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- ======================= All Category ======================== -->

    <!-- ======================= Customer Review ======================== -->
    <section class="gray">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Testimonials</h2>
                        <h3 class="ft-bold pt-3">Client Reviews</h3>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                    <div class="reviews-slide px-3">


                        @foreach ($customer_review as $customer_review)
                        <div class="single_review">
                            <div class="sng_rev_thumb">
                                <figure>
                                    @if ($customer_review->rel_to_customers->customer_photo == null)
                                    <img src="{{ Avatar::create($customer_review->rel_to_customers->customer_name)->toBase64() }} "
                                    class="img-fluid circle"/>
                                @else
                                <img src="{{ asset('uploads/customer_photo') }}/{{$customer_review->rel_to_customers->customer_photo}}" class="img-fluid circle"
                                alt="" />
                                @endif
                                    </figure>
                            </div>
                            <div class="sng_rev_caption text-center">
                                <div class="rev_desc mb-4">
                                    <p class="fs-md">{{$customer_review->review}}</p>
                                </div>
                                <div class="rev_author">
                                    <h4 class="mb-0">{{$customer_review->rel_to_customers->customer_name}}</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach


                        <!-- single review -->


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Customer Review ======================== -->

    <!-- ======================= Top Seller Start ============================ -->
    <section class="space min">
        <div class="container">

            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="top-seller-title">
                        <h4 class="ft-medium">Top Seller</h4>
                    </div>
                    <div class="ftr-content">

                        <!-- Single Item -->
                        @foreach($top_seller as $top_seller)
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden"href="{{route('product_detiles',$top_seller->rel_to_product->product_slug)}}"><img
                                            class="card-img-top" src="{{ asset('uploads/product_photo/preview') }}/{{ $top_seller->rel_to_product->preview }}"
                                            alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">{{$top_seller->rel_to_product->relation_to_category->category_name}}</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('product_detiles',$top_seller->rel_to_product->product_slug)}}">{{$top_seller->rel_to_product->product_name}}</a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">

                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>

                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK-{{$top_seller->rel_to_product->product_after_discount_price}}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="ftr-title">
                        <h4 class="ft-medium">Featured Products</h4>
                    </div>
                    <div class="ftr-content">
                        <!-- Single Item -->
                        @foreach ($featured_products as $featured_product)
                            <div class="product_grid row">
                                <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                    <div class="shop_thumb position-relative">
                                        <a class="card-img-top d-block overflow-hidden" href="{{route('product_detiles',$featured_product->product_slug)}}"><img
                                                src="{{ asset('uploads/product_photo/preview') }}/{{ $featured_product->preview }}"
                                                width="80" height="80" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                    <div class="text-left mfliud">
                                        <div class="elso_titl"><span
                                                class="small">{{ $featured_product->relation_to_sub_category->sub_category_name }}</span>
                                        </div>
                                        <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('product_detiles',$featured_product->product_slug)}}">{{ $featured_product->product_name }}</a></h5>
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                        </div>

                                        <div class="elis_rty"><span class="ft-bold text-dark fs-sm">
                                            @if ($featured_product->product_discount_price)
                                                <span
                                                    class="ft-medium text-muted line-through fs-md mr-2">TK-{{ $featured_product->product_reguler_price }}</span>
                                            @endif TK-{{ $featured_product->product_after_discount_price }}
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="ftr-title">
                        <h4 class="ft-medium">Recent Products</h4>
                    </div>
                    <div class="ftr-content">
                        <!-- Single Item -->
                        @foreach ($recent_view_product as $recent_view_product)
                        <div class="product_grid row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="{{route('product_detiles',$recent_view_product->product_slug)}}"><img
                                            class="card-img-top"src="{{ asset('uploads/product_photo/preview') }}/{{ $recent_view_product->preview }}"
                                            alt="..."></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                                <div class="text-left mfliud">
                                    <div class="elso_titl"><span class="small">{{$recent_view_product->relation_to_category->category_name}}</span></div>
                                    <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('product_detiles',$recent_view_product->product_slug)}}">{{$recent_view_product->product_name}}
                                            </a></h5>
                                    <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK-{{$recent_view_product->product_after_discount_price}}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- ======================= Top Seller Start ============================ -->
@endsection
