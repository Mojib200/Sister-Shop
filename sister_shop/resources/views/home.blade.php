@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        </ol>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 style="color: blueviolet">Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h3 style="color:blue">Welcome Dashboard {{Auth::user()->name}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
