@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)"> Product / Variation </a></li>
        </ol>
    </div>
<div class="row">

    <div class="col-lg-5">
        <div class="card">

            <div class="card-header">
                <h1  class="text-center">View Size</h1>

            </div>
            <div class="card-body">
                <table class="table table-striped" >
                    <tr>
                        <th>SL</th>
                        <th>Size Name</th>
                        <th>Action</th>
                        <th>Create At</th>
                    </tr>
                    @foreach ($sizes as $size)
                    <tr>
                       <td>{{$size->id}}</td>
                       <td>{{$size->size_name}}</td>
                       <td><div class="mb-2"> <a href="{{ route('size_delete',$size->id)}}"class="btn btn-danger">Delete</a></div></td>
                       <td>{{$size->created_at}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">

            <div class="card-header">
                <h1  class="text-center">View Color</h1>

            </div>
            <div class="card-body">
                <table class="table table-striped" >
                    <tr>
                        <th>SL</th>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Action</th>
                        <th>Create At</th>
                    </tr>
                    @foreach ($colors as $color)
                    <tr>
                       <td>{{$color->id}}</td>
                       <td>{{$color->color_name}}</td>
                       <td> <i style="width: 50px ;height:50px;background:{{$color->color_code}};">{{$color->color_code}}</i>
                        {{-- {{$color->color_code==null?'No Color':''}}  eccha korle use3 kora jabe jokhon color thakbe na --}}
                    </td>
                    <td><div class="mb-2"> <a href="{{ route('color_delete',$color->id)}}"class="btn btn-danger">Delete</a></div></td>

                       <td>{{$color->created_at}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">

            <div class="card-header">
                <h1>Add Color </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('product_color') }}" method="post" >
                @csrf

                    <div class="mb-3">
                        <label for=""class="form-label">Color</label>
                          <input type="text" class="form-control" name="color_name">

                      </div>
                      @error('color_name')
                      <div class="alert alert-danger mb-3">{{$message}}
                      </div>
                      @enderror
                    <div class="mb-3">
                        <label for=""class="form-label">Color</label>
                          <input type="color" class="form-control" name="color_code">

                      </div>
                      @error('color_code')
                      <div class="alert alert-danger mb-3">{{$message}}
                      </div>
                      @enderror
                    <div class="mb-3 pt-2">
                     <button class="btn btn-primary" type="submit">Add Color </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">

            <div class="card-header">
                <h1>Add  Size </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('product_size') }}" method="post" >
                @csrf

                    <div class="mb-3">
                      <label for=""class="form-label">Size</label>
                        <input type="text" class="form-control" name="size_name">

                    </div>
                    @error('size_name')
                    <div class="alert alert-danger mb-3">{{$message}}
                    </div>
                    @enderror
                    <div class="mb-3 pt-2">
                     <button class="btn btn-primary" type="submit">Add  Size</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
