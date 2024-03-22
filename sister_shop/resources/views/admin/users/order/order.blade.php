@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)"> Orders </a></li>
        </ol>
    </div>
    @can('show_orders')
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">

                <div class="card-header">
                    <h1>Orders List</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Order Date</th>
                            <th>Order ID</th>
                            <th>Sub Total </th>
                            <th>Discount </th>
                            <th>Charge</th>
                            <th>Total</th>
                            <th>Payment Mathod</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->subtotal }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->charge }}</td>
                                <td>{{ $order->total }}</td>
                                @if ($order->payment_method == 1)
                                    <td>Cash on Delivery</td>
                                @elseif($order->payment_method == 2)
                                    <td>Pay With SSLCommerz</td>
                                @else
                                    <td>Pay With Stripe</td>
                                @endif

                                {{-- {{route('order_delete',$order->id)}}
                                <div><a href=""class="btn btn-danger ">Delete</a></div>
                                    <div><a href=""class="btn btn-danger ">Delete</a></div>
                                    //
                            --}}
                                <td><span class=" badge badge-primary">
                                        @if ($order->status == 0)
                                            Placed
                                        @elseif($order->status == 1)
                                            Packaging
                                        @elseif($order->status == 2)
                                            Shipped
                                        @elseif($order->status == 3)
                                            Ready To Delivery
                                        @elseif($order->status == 4)
                                            Delivery
                                        @else
                                            Cancel
                                        @endif

                                    </span>

                                </td>

                                <td>
                                    <form action="{{ route('order_status') }}" method="post">
                                        @csrf
                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . '0' }}"
                                            class="btn btn-primary mb-2 ">Placed</button>
                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . '1' }}"
                                            class="btn btn-secondary mb-2">Packaging</button>
                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . '2' }}"
                                            class="btn btn-warning mb-2">Shipped</button>
                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . '3' }}"
                                            class="btn btn-info mb-2">Ready To Delivery</button>
                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . '4' }}"
                                            class="btn btn-success mb-2">Delivery</button>
                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . '5' }}"
                                            class="btn btn-danger mb-2">Cancel</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach




                    </table>


                </div>
            </div>
        </div>

    </div>
    @endcan

@endsection
