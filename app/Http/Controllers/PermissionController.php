<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view_permission', ['only' => ['index']]);
        $this->middleware('permission:create_permission', ['only' => ['create','store']]);
        $this->middleware('permission:update_permission', ['only' => ['update','edit']]);
        $this->middleware('permission:delete_permission', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ],
            'module_name' => [
                'required'
            ]
        ]);

        Permission::create([
            'module_name' => $request->module_name,
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ],
            'module_name' => [
                'required'
            ]
        ]);

        $permission->update([
            'module_name' => $request->module_name,
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status','Permission Deleted Successfully');
    }
}
