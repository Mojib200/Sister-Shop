@extends('frontend\frontend_master')
@section('content')
	<!-- ======================= Top Breadcrubms ======================== -->
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">

                <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                    <div class="d-block border rounded">
                        <div class="dashboard_author px-2 py-5">
                            <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                                @if (Auth::guard('customer_logins')->user()->customer_photo == null)
                                    <img src="{{ Avatar::create(Auth::guard('customer_logins')->user()->customer_name)->toBase64() }} "
                                        width="80" />
                                @else
                                    <img src="{{ asset('/uploads/customer_photo') }}/{{ Auth::guard('customer_logins')->user()->customer_photo }}"
                                        width="80" height="80" class="rounded-circle"alt="" />
                                @endif
                            </div>
                            <div class="dash_caption">
                                <h4 class="fs-md ft-medium mb-0 lh-1">{{Auth::guard('customer_logins')->user()->customer_name}}</h4>
                                <span class="text-muted smalls">{{Auth::guard('customer_logins')->user()->customer_country}}</span>
                            </div>
                        </div>

                        <div class="dashboard_author">
                            <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                            <ul class="dahs_navbar">
                                <li><a href="{{route('customer_my_order_list')}}" class="active"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                                <li><a href="{{route('view_wishlist')}}"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                                <li><a href="{{route('customer_profile')}}"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                                <li><a href="{{ route('customer_logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <!-- Single Order List -->
                    @foreach ($order_infos as $order_info)
                    <div class="ord_list_wrap border mb-4">
                        <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                            <div class="olh_flex">
                                <p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
                                <h6 class="mb-0 ft-medium">{{$order_info->order_id}}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 ml-auto">
                              <a href="{{route('download_invoice',$order_info->id)}}" class="ft-medium small text-white bg-info rounded px-3 py-1">Download Invoice</a>
                            </div>
                            <div class="col-xl-4 col-lg-2 col-md-2 col-12 ml-auto">
                                <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                                <div class="delv_status"><span class="ft-medium small text-white bg-{{$order_info->status  <= 4?'badge badge-success':'badge badge-danger'}} rounded px-3 py-1" >
                                     @if ( $order_info->status  == 0)
                                     Placed
                                @elseif($order_info->status  == 1)
                                 Packaging
                                @elseif($order_info->status  == 2)
                                 Shipped
                                @elseif($order_info->status  == 3)
                                 Ready To Delivery
                                @elseif($order_info->status  == 4)
                                 Delivery
                                @else
                               Cancel Order
                                @endif
    </span>
</div>
                            </div>
                        </div>
                        <div class="ord_list_body text-left">
                            <!-- First Product -->
                            @foreach( App\Models\OrderProduct::where('order_id', $order_info->order_id)->get() as $product_info)
                           <div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class="cart_single d-flex align-items-start mfliud-bot">
                                    <div class="cart_selected_single_thumb">
                                        <a href="#"><img src="{{ asset('/uploads/product_photo/preview') }}/{{$product_info->rel_to_product->preview }}" width="150" height="75" class="img-fluid rounded" alt=""></a>
                                    </div>
                                    <div class="cart_single_caption pl-3">
                                        <p class="mb-0"><span class="text-muted small">{{$product_info->rel_to_product->relation_to_category->category_name}}</span></p>
                                        <h4 class="product_title fs-sm ft-medium mb-1 lh-1">{{$product_info->rel_to_product->product_name}}</h4>
                                        <p class="mb-2"><span class="text-dark medium">Size: {{$product_info->rel_to_size->size_name}}</span>, <span class="text-dark medium">Color:{{$product_info->rel_to_color->color_name}}</span></p>
                                        <h4 class="fs-sm ft-bold mb-0 lh-1">TK {{$product_info->rel_to_product->product_after_discount_price}} X {{$product_info->quantity}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach



                        </div>
                        <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-between">
                                <div class="olf_flex_inner"><p class="m-0 p-0"><span class="text-muted medium text-left">Order Date: {{$order_info->created_at->format('d-M-Y')}}</span></p></div>
                                <div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Total: TK {{$order_info->total}}</h5></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- End Order List -->

                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->
@endsection
