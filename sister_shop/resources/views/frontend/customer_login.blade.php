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
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login And Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Login Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="mb-3">
                        <h3>Login</h3>
                    </div>
                    <form action="{{route('customer_login_this')}}" method="POST" class="border p-3 rounded">
                        @csrf
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="Email*">
                            {{-- <input type="hidden" name="email" class="form-control" placeholder="Email*"> --}}
                        </div>
                        <div>
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" placeholder="">
                        </div>
                        <div>
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="eltio_k2">
                                    <a href="{{route('customer_password_reset_request')}}">Lost Your Password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                        </div>
                        <div class=" row align-items-start justify-content-between col-xl-12 col-lg-6 col-md-6 col-sm-6 ">
                        <div class="my-3 btn btn-success">
                            <a href="{{route('google_redirect')}}">  <img src="https://i.postimg.cc/bvBxGgG7/pngtree-facebook-social-media-icon-png-image-6315968.png" width="30" height="30" alt=""> With Google</a>
                        </div>
                        <div class="my-3 btn btn-info">
                            <a href="{{route('github_redirect')}}">  <img src="https://i.postimg.cc/50zCXVWz/pngtree-facebook-social-media-icon-png-image-6315968.png" width="30" height="30" alt=""> With GitHUb</a>
                        </div>
                        {{-- <div class="my-3 btn btn-warning">
                            <a href="{{route('facebook_redirect')}}">  <img src="https://i.postimg.cc/y6ZqmPhy/pngtree-facebook-social-media-icon-png-image-6315968.png" width="30" height="30" alt=""> With Facebook</a>
                        </div> --}}
                        </div>
                    </form>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
                    <div class="mb-3">
                        <h3>Register</h3>
                    </div>
                    <form action="{{ route('customer_register_store') }}" method="POST" class="border p-3 rounded">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Full Name *</label>
                                <input type="text" name="customer_name" class="form-control" placeholder="Full Name">
                            </div>
                            <div>
                                @error('customer_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" name="email" class="form-control" placeholder="Email*">
                        </div>
                        <div>
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password *</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="">
                                    <div>
                                        @error('password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Confirm Password *</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="">
                                    <div>
                                        @error('customer_password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create
                                An Account</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
