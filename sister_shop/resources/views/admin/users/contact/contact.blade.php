@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)"> Profile /Contact</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="mb-3 pt-2">
                    <button class="btn btn-primary" type="submit"> Add To Contact</button>
                </div>
                <div class="card-header">
                    <h1> Contact Information</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('contact_info') }}" method="post">
                        @csrf
                        <div class="row bg-success text-white">
                            <div class="mb-3 col-lg-4  ">
                                <label for="">Company Email:</label>
                                <input type="email" name="company_email" placeholder="Company Email"
                                    value="{{ $contact_information->company_email ?? 'Company Email' }}">
                            </div>
                            <div class="mb-3 col-lg-4  ">
                                <label for="">Company Number:</label>
                                <input type="number" name="company_number" placeholder="Company Number"
                                    value="{{ $contact_information->company_number ?? '0123456789' }}">
                            </div>
                            <div class="col-lg-4  ">
                                <label for="">Company Location:</label>
                                <input type="text" name="company_location" placeholder="Company Location"
                                    value="{{ $contact_information->company_location ?? 'Company Location' }}">
                            </div>
                            <div class="mb-3 col-lg-4  ">
                                <label for="">Company Facebook:</label>
                                <input type="text" name="company_facebook" placeholder="Company Facebook"
                                    value="{{ $contact_information->company_facebook ?? 'Company Facebook' }}">
                            </div>
                            <div class="col-lg-4  ">
                                <label for="">Company Instagram:</label>
                                <input type="text" name="company_instagram" placeholder="Company Instagram"
                                    value="{{ $contact_information->company_instagram ?? 'Company Instagram' }}">
                            </div>
                            <div class="col-lg-4  ">
                                <label for="">Company Youtube:</label>
                                <input type="text" name="company_youtube" placeholder="Company Youtube"
                                    value="{{ $contact_information->company_youtube ?? 'Company Youtube' }}">
                            </div>
                        </div>
                        <div class="mb-3 pt-2">
                            <button class="btn btn-primary" type="submit"> Add To Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card bg-info ">

                <div class="card-header">
                    <h1  class="text-center text-white">Show Customer Message</h1>

                </div>
                <div class="card-body ">
                    <table class="table table-striped text-white" >
                        <tr>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Number </th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                            <th>Create At</th>
                        </tr>
                        @foreach ($customer_message as $customer_message)
                        <tr>

                            <td>{{$customer_message->customer_name}}</td>
                            <td>{{$customer_message->customer_email}}</td>
                            <td>{{$customer_message->customer_number}}</td>
                            <td>{{$customer_message->customer_subject}}</td>
                            <td>{{$customer_message->customer_message}}</td>
                            <td> <div class="mb-2"> <a
                                href="{{ route('customer_message_delete', $customer_message->id) }}"class="btn btn-danger">Delete</a></td>
                            <td>{{$customer_message->created_at}}</td>
                        </tr>

                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
