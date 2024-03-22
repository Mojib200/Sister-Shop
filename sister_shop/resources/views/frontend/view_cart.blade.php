@extends('frontend.frontend_master')

@section('content')
    <!-- ======================= Top Breadcrubms ======================== -->
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Support</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Product Detail ======================== -->
    <section class="middle">
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('update_cart') }}" method="POST">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-7 col-md-12">
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach ($cart_infos as $cart_info)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <!-- Image -->
                                            <a href="product.html"><img
                                                    src="{{ asset('uploads/product_photo/preview') }}/{{ $cart_info->relation_to_product_info->preview }}"
                                                    width="150" class="img-fluid" alt="" /></a>
                                        </div>
                                        <div class="col d-flex align-items-center justify-content-between">
                                            <div class="cart_single_caption pl-2">
                                                <h4 class="product_title fs-md ft-medium mb-1 lh-1">Product-
                                                    {{ $cart_info->relation_to_product_info->product_name }}</h4>
                                                @if ($cart_info->size_id == null)
                                                    <h4 class="fs-md ft-medium mb-1 lh-1">Size- Size Empty</h4>
                                                @else
                                                    <h4 class="fs-md ft-medium mb-1 lh-1">Size-
                                                        {{ $cart_info->relation_to_size_info->size_name }}</h4>
                                                @endif
                                                @if ($cart_info->color_id == null)
                                                    <h4 class="fs-md ft-medium mb-1 lh-1">Color- Color Empty</h4>
                                                @else
                                                    <h4 class="fs-md ft-medium mb-1 lh-1">Color-
                                                        {{ $cart_info->relation_to_color_info->color_name }}</h4>
                                                @endif

                                                <h4 class="fs-md ft-medium mb-1 lh-1">Price-
                                                    TK-{{ $cart_info->relation_to_product_info->product_after_discount_price }}
                                                </h4>
                                                <h4 class="fs-md ft-medium mb-1 lh-1">All Ready selected Quantity
                                                    -{{ $cart_info->quantity }}
                                                </h4>
                                                <select class="mb-2 custom-select w-auto"
                                                    name="quantity[{{ $cart_info->id }}]">
                                                    @for ($i = 1; $i <= 30; $i++)
                                                        <option value="{{ $i }}" selected="">
                                                            {{ $i }}</option>
                                                    @endfor

                                                </select>

                                            </div>
                                            <div class="fls_last"><a href="{{ route('remove_view', $cart_info->id) }}"
                                                    class="close_slide gray"><i class="ti-close"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @php
                                    $subtotal = $subtotal + $cart_info->relation_to_product_info->product_after_discount_price * $cart_info->quantity;
                                @endphp
                            @endforeach
                        </ul>

                        <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                            <div class="col-12 col-md-auto mfliud">
                                <button type="submit" class="btn stretched-link borders">Update Cart</button>
                            </div>
            </form>
            <div class="col-12 col-md-7">
                @if ($message)
                    <div class="alert alert-danger text-center">{{ $message }}</div>
                @endif
                <!-- Coupon -->
                <form class="mb-7 mb-md-0" action="{{ route('view_cart') }}" method="GET">
                    <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                    <div class="row form-row">
                        <div class="col">
                            <input class="form-control" value="{{ @$_GET['coupon_code'] }}" name="coupon_code"
                                type="text" placeholder="Enter coupon code*">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-dark" type="submit">Apply</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        </div>


        @php
        if ($copon_type != 0){
            if($copon_type == 1){
                $discount = ($subtotal * $discount) / 100;
                $total = $subtotal - $discount;

            }
            else {
                $discount = ($cart_info->quantity  * $discount) ;
                $total = $subtotal - $discount;
            }
        }
        else {
            $total=$subtotal;
        }
        @endphp


        <div class="col-12 col-md-12 col-lg-4">
            <div class="card mb-4 gray mfliud">
                <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">TK- {{ $subtotal }}</span>
                        </li>

                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Discount</span> <span class="ml-auto text-dark ft-medium">
                                TK-{{ $discount }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Total</span> <span class="ml-auto text-dark ft-medium">TK- {{ $total }}</span>
                        </li>
                        <li class="list-group-item fs-sm text-center">
                            Shipping cost calculated at Checkout *
                        </li>
                    </ul>
                </div>
            </div>
@php
$sub_total = $subtotal - $discount;
session([
    'discount'=>$discount,
    'sub_total'=>$sub_total,
])

@endphp
            <a class="btn btn-block btn-dark mb-3" href="{{route('check_out')}}">Proceed to Checkout</a>

            <a class="btn-link text-dark ft-medium" href="shop.html">
                <i class="ti-back-left mr-2"></i> Continue Shopping
            </a>
        </div>

        </div>

        </div>
    </section>
@endsection
