@extends('layouts\dashboard')
@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Brand / List </a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">

                    <div class="card-header">
                        <h1 class="text-center">Brands</h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Brand Name </th>
                                <th>Brand Logo</th>
                                <th>Action</th>
                                <th>Create At</th>
                            </tr>
                            @foreach ($all_info_brands as $all_info_brand)
                                <tr>
                                    <td>{{ $all_info_brand->id }}</td>
                                    <td>{{ $all_info_brand->brand_name }}</td>
                                    <td>@if ($all_info_brand->brand_logo==null)
                                        Logo Not Insert
                                        @else
                                        <img src="{{asset('uploads/brand')}}/{{ $all_info_brand->brand_logo }}"height="80" width="80"
                                        alt=""></td>
                                    @endif

                                    <td>
                                        <div class="mb-2">
                                            <a href=""class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>

                                    <td>{{ $all_info_brand->created_at }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-header">
                        <h1>Add Brand </h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_brands') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for=""class="form-label">Brand Name</label>
                                <input type="text" class="form-control" name="brand_name">

                            </div>
                            <div class="mb-3">
                                <label for=""class="form-label">Brand Logo</label>
                                <input type="file" class="form-control" name="brand_logo">

                            </div>


                            <div class="mb-3 pt-2">
                                <button class="btn btn-primary" type="submit">Add Brand </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
