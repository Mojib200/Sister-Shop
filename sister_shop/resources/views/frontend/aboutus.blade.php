@extends('frontend\frontend_master')
@section('content')
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= About Us Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row align-items-center justify-content-between">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="abt_caption">
                    <h2 class="ft-medium mb-4">My Self?</h2>
                    <p class="mb-4">{{ $about_us_info->founder_myself }}</p>
                    <div class="form-group mt-4">
                        <a href="{{$contact_information->company_facebook}}" class="btn btn-dark">See More Info</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="abt_caption">
                    <img src="{{ asset('uploads/about_us_photo/profile_photo') }}/{{ $about_us_info->profile_photo }}" class=" rounded-circle right" width="450" height="450" />

                </div>
            </div>

        </div>
    </div>
</section>
<section class="middle">
    <div class="container">
        <div class="row align-items-center justify-content-between">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="abt_caption">
                    <img src="{{ asset('uploads/about_us_photo/cover_photo') }}/{{ $about_us_info->cover_photo }}" class=" rounded-circle" width="500" height="500" />
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="abt_caption">
                    <h2 class="ft-medium mb-4">{{ $about_us_info->founder_name }}</h2>
                    <p class="mb-4">{{ $about_us_info->founder_journey }}</p>
                    <div class="form-group mt-4">
                        <a href="{{$contact_information->company_facebook}}" class="btn btn-dark">See More Info</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
