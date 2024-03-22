@extends('layouts\dashboard')
@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> Role Manager</a></li>
            </ol>
        </div>
    </div>
    @can('add_role')
        <div class="row">

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role_create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="role_name">
                            </div>
                            <div class="mb-3">
                                <h5>Select Permission</h5>
                                <div class="form-group">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" multiple name="permissions[]" class="form-check-input"
                                                    value="{{ $permission->name }}">{{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add Role</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-header">
                        <h3>Assigned Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('assigend_role') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for=""class="form-lable">User name : </label>
                                <select name="user_id" id="" class="from-control">
                                    <option value=""> ---Select user---</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for=""class="form-lable">User Role: </label>
                                <select name="role_id" id="" class="from-control">
                                    <option value=""> ---Select User Role---</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info"> Assigned</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-header">
                        <h3>Add Permission</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permission') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for=""class="form-lable">Permission Name</label>
                                <input type="text" class="form-control" name="permission" placeholder="Permission name">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info"> Permission</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="row">
        @can('show_role')
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h1 class="text-center">Role List</h1>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->getAllPermissions() as $permission)
                                            <span class="badge badge-info my-2">{{ $permission->name }}</span>
                                        @endforeach

                                    </td>
                                    <td>
                                        <a href="{{ route('role_edit', $role->id) }}" class="btn btn-success my-2">Edit</a>
                                        {{-- <a href="" class="btn btn-danger my-2">Delete</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endcan


        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h1 class="text-center">User List</h1>

                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @forelse ($user->getRoleNames() as $role_name)
                                        <span class="badge badge-info "> {{ $role_name }}</span>
                                    @empty
                                        Not Assigned Yet
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('remove_user_role', $user->id) }}"
                                        class="btn btn-danger my-2">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection
