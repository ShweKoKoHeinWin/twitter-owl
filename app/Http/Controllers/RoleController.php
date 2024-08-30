<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        if($search = request()->query('search')) {
            $roles = Role::where('name', 'LIKE', "%$search%")->get();
        } else {
            $roles = Role::all();
        }
       
        return view('admin.role.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store() {
        $validated = request()->validate([
            'name' => ['required'],
            'permissions' => ['nullable', 'array']
        ]);
        // create role
        $role = Role::create([
            'name' => $validated['name']
        ]);
        // sync permission 
        $role->syncPermissions($validated['permissions']);
        return redirect()->route('admin.role')->with('alert-success', "Created Role($role->name) successfully.");
    }

    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Role $role) {
        $validated = request()->validate([
            'name' => ['required'],
            'permissions' => ['nullable', 'array']
        ]);
        // update role
        $role->update([
            'name' => $validated['name']
        ]);
        // sync permissions
        $role->syncPermissions($validated['permissions']);
        return redirect()->route('admin.role')->with('alert-success', "Updated Role($role->name) successfully.");
    }

    public function destroy(Role $role) {
        $role->delete();
        return redirect()->route('admin.role')->with('alert-success', 'Deleted role successfully.');
    }
}
