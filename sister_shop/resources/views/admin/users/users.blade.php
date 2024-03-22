@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User List </a></li>
            </ol>
        </div>
        @can('user_list')
        <div class="row">
            <div class="col-lg-9 m-auto">
                <div class="card">
                    @if(session('success'))
                    <h6 class="alert alert-danger text-center">
                        {{ session('success') }}
                    </h6>
                @endif
                    <div class="card-header">

                        <h1>Welcome, <h3 class="text-center">Name : {{ Auth::user()->name }}</h3><h3 class="text-right">Total Users-{{ $total_users }}</h3>
                        </h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>User Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Create At time</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $users)
                                <tr>
                                  <td>  @if ($users->profile_photo==null)
                                    <img src="{{ Avatar::create($users->name)->toBase64() }}" width="50" />
                                        @else
                                        <img src="{{ asset('/uploads/profile_photo') }}/{{ $users->profile_photo }}"
                                        alt="" width="50" height="50">
                                        @endif</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->created_at->diffForHumans() }}</td>
                                    <td>
                                        @can('user_delete')
                                        <a href="{{ route('index_delete', $users->id) }}"class="btn btn-danger">Delete</a>
                                        @endcan

                                    </td>

                                </tr>
                            @endforeach



                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Add New User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user_register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text"  name="name" class="form-control">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password"  name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add user</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endcan

    </div>
@endsection
