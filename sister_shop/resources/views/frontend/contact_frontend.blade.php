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
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Contact Page Detail ======================== -->
<section class="middle">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Contact Us</h2>
                    <h3 class="ft-bold pt-3">Get In Touch</h3>
                </div>
            </div>
        </div>

        <div class="row align-items-start justify-content-between">

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="card-wrap-body mb-4">
                    <h4 class="ft-medium mb-3 theme-cl">Make a Call</h4>
                    <p>{{$contact_infor->company_location}}</p>
                    <p class="lh-1"><span class="text-dark ft-medium">Email:</span> {{$contact_infor->company_email}}</p>
                </div>

                <div class="card-wrap-body mb-3">
                    <h4 class="ft-medium mb-3 theme-cl">Make a Call</h4>
                    <h6 class="ft-medium mb-1">Customer Care:</h6>
                    <p class="mb-2">0{{$contact_infor->company_number}}</p>
                    <h6 class="ft-medium mb-1">Careers::</h6>
                    <p>0{{$contact_infor->company_number}}</p>
                </div>

                <div class="card-wrap-body mb-3">
                    <h4 class="ft-medium mb-3 theme-cl">Drop A Mail</h4>
                    <p>Fill out our form and we will contact you within 24 hours.</p>
                    <p class="lh-1 text-dark">{{$contact_infor->company_email}}</p>
                </div>
            </div>

            <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
                <form class="row" action="{{route('customer_send_infos')}}" method="post">
                    @csrf
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Your Name *</label>
                            <input type="text" class="form-control" name="customer_name">
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Your Email *</label>
                            <input type="text" class="form-control" name="customer_email">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Your Phone Number *</label>
                            <input type="text" class="form-control" name="customer_number">
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Subject</label>
                            <input type="text" class="form-control" name="customer_subject" >
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Message</label>
                            <textarea class="form-control ht-80" name="customer_message"></textarea>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Send Message</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>
@endsection
