@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Product/View </a></li>
            </ol>
        </div>
        @can('show_product')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if (session('delete_success'))
                        <h6 class="alert alert-info text-center text-danger">
                            {{ session('delete_success') }}
                        </h6>
                    @endif
                    <div class="card-header">
                        <h1 class="text-center">View Product</h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>C_N</th>
                                    <th>S_C_N</th>
                                    <th>Product_N</th>
                                    <th>Brand</th>
                                    <th>R_Price</th>
                                    <th>D_P%</th>
                                    <th>Preview</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->relation_to_category->category_name }}</td>
                                        <td>{{ $product->relation_to_sub_category->sub_category_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->brand == null ? 'No Brand' : $product->brand }}</td>
                                        <td>{{ $product->product_reguler_price }}</td>
                                        <td>{{ $product->product_discount_price == null ? 'No Discount' : $product->product_discount_price }}
                                        </td>
                                        <td><img src="{{ asset('/uploads/product_photo/preview') }}/{{ $product->preview }}"
                                                alt="" width="40" height="40"></td>
                                        <td>
                                            <div class="mb-2"> <a
                                                    href="{{ route('inventory', $product->id) }}"class="btn btn-success">Inventory</a>
                                            </div>
                                            <div class="mb-2">
                                                @can('delete_product')
                                                <a href="{{ route('product_hard_delete', $product->id) }}"class="btn btn-danger">Delete</a>
                                                @endcan

                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>


        </div>
        @endcan

    </div>
@endsection
