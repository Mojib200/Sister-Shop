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
                            <li class="breadcrumb-item active" aria-current="page">Profile Information</li>
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
                    <div class="d-block border rounded mfliud-bot">
                        <div class="dashboard_author px-2 py-5">
                            <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                                <a class="popup-title"href="javascript:void(0)" role="button"
                                data-toggle="dropdown">


                                @if (Auth::guard('customer_logins')->user()->customer_photo == null)
                                    <img src="{{ Avatar::create(Auth::guard('customer_logins')->user()->customer_name)->toBase64() }} "
                                        width="80" />
                                @else
                                    <img src="{{ asset('/uploads/customer_photo') }}/{{ Auth::guard('customer_logins')->user()->customer_photo }}"
                                        width="80" height="80" class="rounded-circle"alt="" />
                                @endif
                            </a>
                            </div>
                            <div class="dash_caption">
                                <h4 class="fs-md ft-medium mb-0 lh-1">{{Auth::guard('customer_logins')->user()->customer_name}}</h4>
                                <h4 class="fs-md ft-medium mb-0 lh-1">{{Auth::guard('customer_logins')->user()->email}}</h4>
                                <span class="text-muted smalls">{{Auth::guard('customer_logins')->user()->customer_country}}</span>
                            </div>
                        </div>

                        <div class="dashboard_author">
                            <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                            <ul class="dahs_navbar">
                                <li><a href="{{route('customer_my_order_list')}}"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                                <li><a href="wishlist.html"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                                <li><a href="{{route('customer_profile')}}" class="active"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                                <li><a href="{{ route('customer_logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <!-- row -->
                    <div class="row align-items-center">
                        <form action="{{route('customer_profile_update')}}" method="post" enctype="multipart/form-data" class="row m-0">
                            @csrf
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium"> Name *</label>
                                    <input type="text" class="form-control" name="customer_name" placeholder="" value="{{Auth::guard('customer_logins')->user()->customer_name}}"/>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Email *</label>
                                    <input type="email" name="email" class="form-control" placeholder="" value="{{Auth::guard('customer_logins')->user()->email}}"/>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Current Password *</label>
                                    <input type="password" name="old_password" class="form-control" placeholder="Current Password" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">New Password *</label>
                                    <input type="password" name="password" class="form-control" placeholder="New Password" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Country</label>
                                    <input type="text" name="customer_country" class="form-control" class="form-control" value="{{Auth::guard('customer_logins')->user()->customer_country}}" placeholder="Country" />
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Address</label>
                                    <input type="text" name="customer_address" class="form-control" class="form-control" value="{{Auth::guard('customer_logins')->user()->customer_address}}" placeholder="Address" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Profile Image</label>
                                    <input type="file"  name="customer_photo" class="form-control" />
                                </div>
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">Save Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- row -->
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

@endsection
