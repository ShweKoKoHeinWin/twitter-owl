<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() {
        if($search = request()->query('search')) {
            $permissions = Permission::where('name', 'LIKE', "%$search%")->get();
        } else {
            $permissions = Permission::all();
        }
        return view('admin.permission.index', compact('permissions'));
    }

    public function create() {
        $roles = Role::all();
        return view('admin.permission.create', compact('roles'));
    }

    public function store() {
        $validated = request()->validate([
            'names' => ['required', 'array', function($attribute, $value, $fail) {
                $value = array_filter($value);
                if(count($value) !== count(array_unique($value))) {
                    return $fail('The '.$attribute.' contains duplicate values.');
                }
            }],
            'names.*' => ['nullable', 'min:4', Rule::unique('permissions', 'name')]
        ]);
        $superAdmin = Role::where('name', 'Super Admin')->first();
        foreach(array_filter($validated['names']) as $name) {
            $permission = Permission::create([
                'name' => $name
            ]);
            
            // For each created permission super admin will have them
            $permission->assignRole($superAdmin);
        }
        return redirect()->route('admin.permission')->with('alert-success', 'Updated permission successfully.');
    }

    public function edit(Permission $permission) {
        $roles = Role::all();
        return view('admin.permission.edit', compact('roles', 'permission'));
    }

    public function update(Permission $permission) {
        $validated = request()->validate([
            'name' => ['required', Rule::unique('permissions', 'name')]
        ]);
        $permission->update([
            'name' => $validated['name']
        ]);
        return redirect()->route('admin.permission')->with('alert-success', 'Updated permission successfully.');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->route('admin.permission')->with('alert-success', 'Deleted permission successfully.');
    }

    public function destroyMany() {
        $validated = request()->validate([
            'del-permissions' => ['required', 'array']
        ]);
        $message = "";
        foreach($validated['del-permissions'] as $permission) {
            $message .= "$permission , ";
            $permission = Permission::where('name', $permission)->first();
            $this->destroy($permission);
        }

        return redirect()->route('admin.permission')->with('alert-success', 'Deleted permissions (' . $message. ') successfully.');
    }
}
