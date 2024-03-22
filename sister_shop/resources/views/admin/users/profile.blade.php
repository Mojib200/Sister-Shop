@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)"> Profile </a></li>
    </ol>
</div>
<div class="col-lg-8">
    <div class="card">
        @if(session('update'))
        <h6 class="alert alert-info text-center text-danger">
            {{ session('update') }}
        </h6>
    @endif
        <div class="card-header">
            <h1>Change User Information</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('name_update') }}" method="post">
            @csrf
                <div class="mb-3">
                  <label for=""class="form-label">User Name </label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">

                </div>
                @error('name')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror
                <div class="mb-3">
                  <label for=""class="form-label">User Email </label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                </div>
                @error('email')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror

                <div class="mb-3 pt-2">
                 <button class="btn btn-primary" type="submit">Update User Information</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="card">
        @if(session('profile_photo_success'))
        <h6 class="alert alert-info text-center text-danger">
            {{ session('profile_photo_success') }}
        </h6>
    @endif
        <div class="card-header">
            <h1> User Profile Photo</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('profile_photo') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3 text-center ">
                <img id="profile_photo" src="{{ asset('/uploads/profile_photo') }}/{{ Auth::user()->profile_photo }}"
                    alt="" width="200" height="200" class="rounded-circle">
            </div>
                <div class="mb-3">
                  <label for=""class="form-label">User Profile Photo </label>
                    <input type="file" class="form-control" name="profile_photo"onchange="document.getElementById('profile_photo').src = window.URL.createObjectURL(this.files[0])">

                </div>
                @error('profile_photo')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror


                <div class="mb-3 pt-2">
                 <button class="btn btn-primary" type="submit"> User Profile Photo</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="card">
        @if(session('pass_update'))
        <h6 class="alert alert-info text-center text-danger">
            {{ session('pass_update') }}
        </h6>
    @endif
        <div class="card-header">
            <h1>Change Password</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('password_update') }}" method="post">
            @csrf
                <div class="mb-3">
                  <label for=""class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" >

                </div>
                @error('old_password')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror
                <div class="mb-3">
                  <label for=""class="form-label">New Password </label>
                    <input type="password" class="form-control" name="password" >
                </div>
                @error('password')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror
                <div class="mb-3">
                  <label for=""class="form-label">Confirm Password </label>
                    <input type="password" class="form-control" name="password_confirmation" >
                </div>
                @error('password_confirmation')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror
                <div class="mb-3 pt-2">
                 <button class="btn btn-primary" type="submit">Update User Password</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
 {{-- <div class="mb-3">
                  <label for=""class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" name="profile_photo" value="">
                </div>
                @error('profile_photo')
                <div class="alert alert-danger mb-3">{{$message}}
                </div>
                @enderror --}}
