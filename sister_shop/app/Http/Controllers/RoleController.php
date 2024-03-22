<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function role()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin\users\role\role', [
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }
    function permission(Request $request)
    {
        Permission::create(['name' => $request->permission]);
        return back();
    }
    function role_create(Request $request)
    {
        $permissions = $request->permissions;
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo([$permissions]);
        return back();
    }
    function assigend_role(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);

        return back();
    }
    function remove_user_role($id)
    {
        $user = User::find($id);
        $user->syncRoles([]);
        $user->syncPermissions([]);

        return back();
    }
    function role_edit($id)
    {
        $permission_info = Permission::all();
        $role_info=Role::find($id);
        return view('admin\users\role\edit_role',[
            'role_info'=>$role_info,
            'permission_info'=>$permission_info,
        ]);

    }
    function role_edit_update(Request $request)
    {
        $role= Role::find($request->role_id);
        $role->syncPermissions([$request->permissions]);
        $notification = array(
            'message' => 'Role Update !!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
