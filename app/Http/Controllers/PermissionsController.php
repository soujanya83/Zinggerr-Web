<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $userId = Auth::user()->id;
        $permissions = Permission::all()->map(function ($permission) {
            return $permission->getOriginal(); // Get the original attributes
        })->toArray();

        $defaultRoles = ['Admin', 'Teacher'];

        $role = Role::where(function ($query) use ($userId, $defaultRoles) {
            $query->where('user_id', $userId)
                ->orWhereIn('name', $defaultRoles);
        })
            ->whereNotIn('name', ['Superadmin'])->latest()
            ->get();
        return view('permissions.role_permission', compact('permissions', 'role'));
    }

    public function assignpermissions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $userId = Auth::user()->id;
        $role_id = $request->role_id;
        $permissions = $request->permissions;
        foreach ($permissions as $permission_id) {
            $uuid = (string) Guid::uuid4();
            PermissionRole::updateOrCreate(
                [
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                    'user_id' => $userId,
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name',
            'displayname' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'displayname' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


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
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
                'regex:/^(?!.*superadmin).*$/i',
            ],
            'displayname' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            [
                'name.regex' => 'The role name cannot contain "Superadmin".'
            ]
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        try {
            $uuid = (string) Guid::uuid4(); // Use Laravel's built-in Str helper for UUID
            Role::create([
                'id' => $uuid,
                'name' => $request->name,
                'user_id' => $userId,
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
        $userId = Auth::user()->id;

        $defaultRoles = ['Teacher', 'Admin', 'Student'];

        $roles = Role::where(function ($query) use ($userId, $defaultRoles) {
            $query->where('user_id', $userId)
                ->orWhereIn('name', $defaultRoles);
        })
            ->whereNotIn('name', ['Superadmin'])->latest()
            ->get();

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
            return redirect()->back()->with('error', 'Role ID not found.');
        }
    }

    public function permissions_assigned_list()
    {
        $userId=Auth::user()->id;
        $permissions = PermissionRole::select('permission_role.id', 'permissions.name', 'permissions.display_name', 'roles.display_name as role_name')->where('permission_role.user_id',$userId)->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')->join('roles', 'roles.id', '=', 'permission_role.role_id')->get();

        return view('permissions.permissions_assigned_list', compact('permissions'));
    }


    public function permissions_assigned_delete($id)
    {
        // if (Gate::denies('role')) {
        //     return redirect()->back()->with('error', 'Unauthorized access.');
        // }
        $assigned = PermissionRole::find($id);
        if ($assigned) {
            $assigned->delete();
            return redirect()->back()->with('success', 'Permissions Assigned deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Permissions Assigned ID not found.');
        }
    }
}
