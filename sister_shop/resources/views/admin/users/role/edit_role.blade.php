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
                        <h3>Edit Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role_edit_update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Edit Role Name</label>
                                <input type="text" readonly class="form-control" value="{{$role_info->name}}">
                                <input type="hidden"  class="form-control" name="role_id" value="{{$role_info->id}}">
                            </div>
                            <div class="mb-3">
                                <h5>Select Permission</h5>
                                <div class="form-group">
                                    @foreach ($permission_info as $permission_info)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" multiple {{($role_info->hasPermissionTo($permission_info->name))?'checked':''}} name="permissions[]" class="form-check-input"
                                                    value="{{ $permission_info->name }}">{{ $permission_info->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Role</button>
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
                            {{-- @foreach ($roles as $role)
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
                                        <a href="" class="btn btn-danger my-2">Delete</a>
                                    </td>
                                </tr>
                            @endforeach --}}
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
                        {{-- @foreach ($users as $user)
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
                        @endforeach --}}
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
