<?php
namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get()->toArray();
        
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'permissions' => 'array|required',
        //     'permissions.*' => 'exists:permissions,id',
        // ]);
        $role = Role::create([
            'name' => $request->input('name')
        ]);

        $role->permissions()->sync($request->input('permissions'));

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully and permissions assigned.'
        ]);
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('admin.roles.index');
    }
}
