@extends('layouts\dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)"> Profile /About us</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-success">
                <div class="card-header">
                    <h1> About Information</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('founder_about_us') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row bg-success text-white">
                            <div class="mb-3 col-lg-4  ">
                                <label for="">Founder Name </label>
                                <input type="text" name="founder_name" placeholder="Founder Name">
                            </div>
                            <div class="mb-3 col-lg-4  ">
                                <label for="">Profile Photo</label>
                                <input type="file" name="profile_photo" placeholder="Profile Photo">
                            </div>
                            <div class="mb-3 col-lg-4  ">
                                <label for="">Cover Photo</label>
                                <input type="file" name="cover_photo" placeholder="Cover Photo">
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class=" text-white ft-medium">Founder My Self</label>
                                    <textarea class="form-control ht-80" name="founder_myself"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class=" text-white ft-medium">Founder Journey</label>
                                    <textarea class="form-control ht-80" name="founder_journey"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 pt-2">
                            <button class="btn btn-primary" type="submit"> Add To Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
