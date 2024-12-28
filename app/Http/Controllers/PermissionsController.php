<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;

class PermissionsController extends Controller
{
    public function create_permission()
    {
        $permissions = Permission::all()->map(function ($permission) {
            return $permission->getOriginal(); // Get the original attributes
        })->toArray();

        return view('permissions.create_permission', compact('permissions'));
    }

    public function role_permission()
    {
        $permissions = Permission::all()->map(function ($permission) {
            return $permission->getOriginal(); // Get the original attributes
        })->toArray();

        $role = Role::whereIn('name', ['Admin', 'Staff'])->get();
        return view('permissions.role_permission', compact('permissions', 'role'));
    }

    public function assignpermissions(Request $request)
    {
        // $request->validate([
        //     'role_id' => 'required|exists:roles,id',
        //     'permissions' => 'required|array',
        //     'permissions.*' => 'exists:permissions,id'
        // ]);



        $role_id = $request->role_id;
        $permissions = $request->permissions;
        foreach ($permissions as $permission_id) {
            $uuid = (string) Guid::uuid4();
            PermissionRole::updateOrCreate(
                [
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                ],
                [
                    'id' => $uuid // This will update `id` if the record exists; adjust as needed
                ]
            );
        }
        return redirect()->route('permissions.role')->with('success', 'Permissions assigned successfully!');
    }


    public function submit_permission(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:permissions,name',
        //     'displayname' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:500',
        // ]);

        try {
            $uuid = (string) Guid::uuid4(); // Use Laravel's built-in Str helper for UUID
            Permission::create([
                'id' => $uuid,
                'name' => $request->name,
                'display_name' => $request->displayname,
                'description' => $request->description,
            ]);

            return redirect()->route('permissions.create')
                ->with('success', 'Permission created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function update_permission(Request $request)
    {
        $permission = Permission::findOrFail($request->id);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->displayname,
            'description' => $request->description,
        ]);

        return redirect()->route('permissions.create')->with('success', 'Permission updated successfully!');
    }
    public function update_role(Request $request)
    {
        $permission = Role::findOrFail($request->id);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->displayname,
            'description' => $request->description,
        ]);

        return redirect()->route('roles.create')->with('success', 'Role updated successfully!');
    }


    public function destroy($id)
    {
        $permission = Permission::findOrfail($id);
        $permission->delete();

        return redirect()->route('permissions.create')
            ->with('success', 'Permission deleted successfully!'); // Redirect with success message
    }

    public function submit_roles(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:permissions,name',
        //     'displayname' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:500',
        // ]);

        try {
            $uuid = (string) Guid::uuid4(); // Use Laravel's built-in Str helper for UUID
            Role::create([
                'id' => $uuid,
                'name' => $request->name,
                'display_name' => $request->displayname,
                'description' => $request->description,
            ]);


            return redirect()->back()
                ->with('success', 'Roles created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function createroles()
    {
        $roles = Role::all();
        return view('roles.create', compact('roles'));
    }

    public function role_delete($id)
    {
        if (Gate::denies('role')) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        $course = role::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Role deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course ID not found.');
        }
    }



}
