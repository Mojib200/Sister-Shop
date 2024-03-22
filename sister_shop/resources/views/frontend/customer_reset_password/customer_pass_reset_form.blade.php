@extends('frontend.frontend_master')

@section('content')

<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Password Reset</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="mb-3">
                    <h3>Reset Password Form</h3>
                </div>
                <form action="{{route('customer_pass_reset')}}" method="POST" class="border p-3 rounded">
                    @csrf
                    <div class="form-group">
                        <label>New Password *</label>
                        <input type="password" name="password" class="form-control" >
                        <input type="hidden" name="customer_token" class="form-control" value="{{$customer_token}}">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Reset Password</button>
                    </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</section>
@endsection
