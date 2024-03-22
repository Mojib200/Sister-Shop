@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Product/Inventroy </a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    @if(session('delete_success'))
                    <h6 class="alert alert-info text-center text-danger">
                        {{ session('delete_success') }}
                    </h6>
                @endif
                    <div class="card-header">
                        <h3  class="text-center">Product Invontroy : {{$product_information->product_name}}</h3>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" >
                            <tr>
                                <th>SL</th>
                                <th>Product ID</th>
                                <th>Color ID</th>
                                <th>Size ID </th>
                                <th>Quantity </th>
                                <th>Action</th>
                            </tr>
                            @foreach ($inventorys as $inventory)
                            <tr>
                                <td>{{$inventory->id}}</td>
                            <td>{{$inventory->product_id}}</td>
                            <td>{{$inventory->relation_to_color->color_name}}</td>
                            <td>{{$inventory->relation_to_size->size_name}}</td>
                            <td>{{$inventory->quantity}}</td>
                            <td><div class="mb-2"> <a href="{{ route('inventory_delete',$inventory->id)}}"class="btn btn-danger">Delete</a></div></td>
                            </tr>
                            @endforeach


                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    @if(session('category_success'))
                    <h6 class="alert alert-info text-center text-danger">
                        {{ session('category_success') }}
                    </h6>
                @endif
                    <div class="card-header">
                        <h1>Product  Inventory</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product_inventory')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                              <label for=""class="form-label">Product Inventory </label>
                                <input type="hidden" class="form-control" name="product_id" value="{{$product_information->id}}">
                                <input type="text" class="form-control" readonly value="{{$product_information->product_name}}" >

                            </div>
                            <div class="mb-3">
                                <label for=""class="form-label">Product Color  </label>
                              <select name="color_id" id="" class="form-control">
                                <option value="">--- Select Color ----</option>
                                @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                              </select>

                            </div>
                            <div class="mb-3">
                                <label for=""class="form-label">Product Size  </label>
                              <select name="size_id" id="" class="form-control">
                                <option value="">--- Select Size ----</option>
                                @foreach ($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                                @endforeach
                              </select>

                            </div>
                            <div class="mb-3">
                                <label for=""class="form-label">Product Quantity  </label>
                                  <input type="number" class="form-control" name="quantity" value="">

                              </div>




                            <div class="mb-3 pt-2">
                             <button class="btn btn-primary" type="submit">Add Inventory</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
