@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Category /Sub Category </a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header  text-white">
                        <h1>Add Sub Category</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub_category_store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for=""class="form-label">Category Name </label>
                                <select name="category_id" class="form-label">
                                    <option value="">-- Select Category ---</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                @error('category_id')
                                    <div class="alert alert-danger mb-3">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for=""class="form-label">Sub Category Name </label>
                                <input type="text" class="form-control" name="sub_category_name">
                            </div>
                            @error('sub_category_name')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for=""class="form-label">Sub Category Image </label>
                                <input type="file" class="form-control" name="sub_category_image"
                                    onchange="document.getElementById('sub_category_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            @if ($sub_categorys != null)
                                <div class="mb-3">
                                    <label for=""class="form-label">Sub Category Image </label>
                                </div>
                                <div class="mb-3 text-center">
                                    <img id="sub_category_image"src="" alt="" width="150" height="150"
                                        class="rounded-circle">
                                </div>
                            @endif
                            @error('sub_category_image')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3 pt-2">
                                <button class="btn btn-primary" type="submit">Add Sub Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h1 class="text-center">View Sub Category</h1>

                    </div>
                    <div class="card-body ">
                        <table class="table table-dark text-center table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    {{-- <th>Category ID</th> --}}
                                    <th>Sub Category Name</th>
                                    <th>Picture</th>
                                    <th>Category name </th>
                                    <th>Added By </th>
                                    <th>Action</th>
                                    <th>Create At</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sub_categorys as $sub_category)
                                    <tr>
                                        {{-- <td>{{ $sub_category->category_id }}</td> --}}
                                        <td>{{ $sub_category->sub_category_name }}</td>
                                        <td><img src="{{ asset('/uploads/sub_category') }}/{{ $sub_category->sub_category_image }}"
                                                alt="" width="50" height="50"></td>
                                            <td>{{ $sub_category->relation_to_sub_category->category_name }}</td>

                                        <td>{{ $sub_category->relation_to_user->name }}</td>
                                        {{--  --}}
                                        <td>
                                            <div class="mb-2"><a
                                                    href="{{ route('sub_category_edit', $sub_category->id) }}"
                                                    class="btn btn-success">Edit</a></div>
                                            {{--  --}}
                                            <div class="mb-2"> <a
                                                    href="{{ route('sub_category_delete', $sub_category->id) }}"class="btn btn-danger">Delete</a>
                                        </td>
                    </div>
                    <td>{{ $sub_category->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
