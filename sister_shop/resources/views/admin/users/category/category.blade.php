@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Category Insert/View </a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    @if(session('delete_success'))
                    <h6 class="alert alert-info text-center text-danger">
                        {{ session('delete_success') }}
                    </h6>
                @endif
                    <div class="card-header">
                        <h1  class="text-center">View Category</h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" >
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>Added By</th>
                                <th>Action</th>
                                <th>Create At</th>
                            </tr>
                            @foreach ($categorys as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->category_name}}</td>
                                <td><img src="{{ asset('/uploads/category_image') }}/{{$category->category_image}}"
                                    alt="" width="50" height="50"></td>
                                    {{-- <td> {{$category->addedby}}</td> --}}
                                <td>{{$category->relation_to_user->name}}</td>
                                {{--  <td>{{$category->relation_to_user->name}}</td>  eta ekta reletion User model to Category model--}}
                                <td><div class="mb-2">
                                    @can('edit_category')
                                    <a href="{{route('category_edit',$category->id)}}" class="btn btn-success">Edit</a>
                                    @endcan
                                </div>
                                    {{-- ['id'=>$category->id]) --}}
                           <div class="mb-2">  @can('delete_category')
                            <a href="{{ route('category_delete',$category->id)}}"class="btn btn-danger">Delete</a>
                            @endcan
                            </td></div>
                                <td>{{$category->created_at}}</td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            @can('add_category')
            <div class="col-lg-4">
                <div class="card">
                    @if(session('category_success'))
                    <h6 class="alert alert-info text-center text-danger">
                        {{ session('category_success') }}
                    </h6>
                @endif
                    <div class="card-header">
                        <h1>Add Category</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                              <label for=""class="form-label">Category Name </label>
                                <input type="text" class="form-control" name="category_name">

                            </div>
                            @error('category_name')
                            <div class="alert alert-danger mb-3">{{$message}}
                            </div>
                            @enderror

                            <div class="mb-3">
                              <label for=""class="form-label">Category Image </label>
                                <input type="file" class="form-control" name="category_image" onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])">
                                <label for=""class="form-label">Insert Image Show</label>
                                <img id="category_image" src=""alt="" width="150" height="150" class="rounded-circle">

                            </div>

                            @error('category_image')
                                <div class="alert alert-danger mb-3">{{$message}}
                                </div>
                                @enderror
                            <div class="mb-3 pt-2">
                             <button class="btn btn-primary" type="submit">Add Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @endcan

            <div class="col-lg-8">
                <div class="card">
                    @if(session('delete_success'))
                    <h6 class="alert alert-info text-center text-danger">
                        {{ session('delete_success') }}
                    </h6>
                @endif
                    <div class="card-header">
                        <h1  class="text-center">Soft Delete View Category</h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" >
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>Added By</th>
                                <th>Action</th>
                                <th>Create At</th>
                            </tr>
                            @foreach ($trashed as $soft_delete)
                            <tr>
                                <td>{{$soft_delete->id}}</td>
                                <td>{{$soft_delete->category_name}}</td>
                                <td><img src="{{ asset('/uploads/category_image') }}/{{$soft_delete->category_image}}"
                                    alt="" width="50" height="50"></td>
                                    {{-- <td> {{$category->addedby}}</td> --}}
                                <td>{{$soft_delete->relation_to_user->name}}</td>
                                {{--  <td>{{$category->relation_to_user->name}}</td>  eta ekta reletion User model to Category model--}}
                                <td><div class="mb-2"><a href="{{route('category_restore',$soft_delete->id)}}" class="btn btn-success">Restore</a></div>
                                    {{-- ['id'=>$category->id]) --}}
                           <div class="mb-2"> <a href="{{ route('category_hard_delete',$soft_delete->id)}}"class="btn btn-danger">Delete</a></td></div>
                                <td>{{$soft_delete->created_at}}</td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
