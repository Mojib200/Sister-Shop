@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Category Edit /View </a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for=""class="form-label">Category Name </label>
                                <input type="text" class="form-control" name="category_name" value="{{$category_information->category_name}}">
                                <input type="hidden" name="category_id" value="{{$category_information->id}}">
                            </div>
                            @error('category_name')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3 ">
                                <label for=""class="form-label">Category Image </label>
                                <input type="file" class="form-control" name="category_image" onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])">
                                <label for=""class="form-label">Insert Image Show</label>
                                <img id="category_image" src="{{ asset('/uploads/category_image') }}/{{$category_information->category_image}}"
                                    alt="" width="150" height="150">
                            </div>

                            @error('category_image')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3 pt-2">
                                <button class="btn btn-primary" type="submit">Edit Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
