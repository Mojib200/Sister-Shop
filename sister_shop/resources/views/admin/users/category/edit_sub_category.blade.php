@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Category /Sub Category/Edit </a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <h1>Edit Sub Category</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub_category_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for=""class="form-label">Sub Category Name </label>
                                <input type="text" class="form-control" name="sub_category_name" value="{{$sub_categorys->sub_category_name}}">
                                <input type="hidden" name="category_id" value="{{$sub_categorys->id}}">
                            </div>
                            @error('sub_category_name')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3 ">
                                <label for=""class="form-label">Sub Category Image </label>
                                <input type="file" class="form-control" name="sub_category_image" onchange="document.getElementById('sub_category_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3 ">
                                <label for=""class="form-label">Insert Image Show</label>
                            </div>
                            <div class="mb-3 text-center ">
                                <img id="sub_category_image" src="{{ asset('/uploads/sub_category') }}/{{$sub_categorys->sub_category_image}}"
                                    alt="" width="250" height="250" class="rounded-circle">
                            </div>

                            @error('sub_category_image')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3 pt-2">
                                <button class="btn btn-primary" type="submit">Edit Sub Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
