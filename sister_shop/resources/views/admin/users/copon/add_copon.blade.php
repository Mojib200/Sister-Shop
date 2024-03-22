@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)"> Coupon/ Add Coupon </a></li>
    </ol>
</div>
@can('add_copon')
<div class="row">
    <div class="col-lg-6">
        <div class="card ">

            <div class="card-header">
                <h1>Add Coupon</h1>
            </div>
            <div class="card-body">
                <form action="{{route('coupon_store')}}" method="POST" >
                @csrf
                    <div class="mb-3">
                      <label for=""class="form-label">Coupon Code </label>
                        <input type="text" class="form-control" name="copon_code">

                    </div>
                    @error('copon_code')
                    <div class="alert alert-danger mb-3">{{$message}}
                    </div>
                    @enderror
                    <div class="mb-3">
                        <label for=""class="form-label">Coupon Type </label>
                       <select name="copon_type" id="" class="form-label">
                        <option value="">---Select Coupon Type---</option>
                        <option value="1">Percentage</option>
                        <option value="2">Solid Amount</option>
                       </select>

                    </div>

                    <div class="mb-3">
                      <label for=""class="form-label">Discount Amount</label>
                        <input type="number" class="form-control" name="discount_amount">

                    </div>
                    @error('discount_amount')
                    <div class="alert alert-danger mb-3">{{$message}}
                    </div>
                    @enderror
                    <div class="mb-3">
                      <label for=""class="form-label">Validity</label>
                        <input type="date" class="form-control" name="validity">

                    </div>
                    @error('validity')
                    <div class="alert alert-danger mb-3">{{$message}}
                    </div>
                    @enderror


                    <div class="mb-3 pt-2">
                     <button class="btn btn-primary" type="submit">Add Coupon</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1  class="text-center">Coupon List</h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" >
                            <tr>
                                <th>SL</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type </th>
                                <th>Discount Amount</th>
                                <th>Validity</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td>{{$coupon->copon_code}}</td>
                                <td>{{($coupon->copon_type)==1?'Percentage':'Solid Amount'}}</td>
                                <td>{{$coupon->discount_amount}}</td>
                                <td class="badge badge-primary" >{{Carbon\Carbon::now()->diffInDays($coupon->validity, false)}} days left</td>

                                <td> <a href="{{route('coupon_delete',$coupon->id)}}"class="btn btn-danger">Delete</a></td>
                            </tr>

                            @endforeach




                        </table>
                    </div>
                </div>
            </div>

</div>
@endcan

@endsection
