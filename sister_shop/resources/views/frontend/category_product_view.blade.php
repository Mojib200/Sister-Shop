@extends('frontend\frontend_master')
@section('content')
    <!-- ======================= Shop Style 1 ======================== -->
    {{-- <section class="bg-cover" style="background:url({{asset('frontend')}}/img/banner-2.png) no-repeat;"> --}}
    <section class="bg-cover" style="background:url(https://i.postimg.cc/PxxJRZqM/IMG-8211.jpg) no-repeat;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-left py-5 mt-3 mb-3">
                        <h1 class="ft-medium mb-3   text-white  text-center"> <span class="btn btn-danger">{{ $category_info->category_name }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h3 class="ft-bold pt-3">Category Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center rows-products">
                <!-- Single -->
                @foreach ($category_product_info as $category_product_info)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">

                            @if ($category_product_info->product_discount_price)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                    -{{ $category_product_info->product_discount_price }}%
                                </div>
                            @endif

                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden"
                                        href="{{ route('product_detiles', $category_product_info->product_slug) }}"><img
                                            src="{{ asset('uploads/product_photo/preview') }}/{{ $category_product_info->preview }}"
                                            width="280" height="280" alt=""></a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                <div class="text-left">
                                    <div class="text-left">
                                        <div class="elso_titl"><span
                                                class="small">{{ $category_product_info->relation_to_sub_category->sub_category_name }}</span>
                                        </div>
                                        <h5 class="fs-md mb-0 lh-1 mb-1"><a
                                                href="{{ route('product_detiles', $category_product_info->product_slug) }}">{{ $category_product_info->product_name }}</a>
                                        </h5>
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="elis_rty"><span class="ft-bold text-dark fs-sm">
                                                @if ($category_product_info->category_product_info_discount_price)
                                                    <span
                                                        class="ft-medium text-muted line-through fs-md mr-2">TK-{{ $category_product_info->product_reguler_price }}</span>
                                                @endif
                                                TK-{{ $category_product_info->product_after_discount_price }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </section>
@endsection
