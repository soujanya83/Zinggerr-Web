<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PermissionsController extends Controller
{



    public function update_role(Request $request)
    {
        $userId = Auth::user()->id;

        $id = $request->input('role_id');

        $role = Role::where('id', $id)->where('user_id', $userId)->first();

        if (!$role) {
            return back()->with('error', 'The selected role does not exist or you do not have permission to edit it.');
        }


        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->where(function ($query) use ($userId, $id) {
                    return $query->where('user_id', $userId)->where('id', '!=', $id);
                }),
                'regex:/^(?!.*superadmin).*$/i',
            ],
            'description' => 'nullable|string|max:500',
        ], [
            'name.regex' => 'The role name cannot contain "Superadmin".'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $role->update([
                'name' => $request->name,
                'display_name' => $request->displayname,
                'description' => $request->description,
            ]);

            return redirect()->route('roles.list')->with('success', 'Role updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }



    public function editroles($id)
    {

        $roles = Role::where('id', $id)->first();

        return view('roles.edit', compact('roles', 'id'));
    }

    public function createroles()
    {

        return view('roles.create');
    }

    public function listroles()
    {
        $userId = Auth::user()->id;
        $defaultRoles = ['Faculty', 'Admin', 'Student'];
        $roles = Role::where(function ($query) use ($userId, $defaultRoles) {
            $query->where('user_id', $userId)
                ->orWhereIn('name', $defaultRoles);
        })
            ->whereNotIn('name', ['Superadmin'])->latest()
            ->get();
        return view('roles.list', compact('roles'));
    }

    public function permission_edit($id)
    {

        $permissionsdata = Permission::where('id', $id)->first();

        return view('permissions.edit_permission', compact('permissionsdata', 'id'));
    }

    public function update_permission(Request $request)
    {
        $per_id = $request->permission_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,'.$per_id,
            'displayname' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $per_id = $request->permission_id;
        try {
            $uuid = (string) Guid::uuid4(); // Use Laravel's built-in Str helper for UUID
            Permission::where('id', $per_id)->update([
                'id' => $uuid,
                'name' => $request->name,
                'display_name' => $request->displayname,
                'description' => $request->description,
            ]);

            return redirect()->route('permissions.list')
                ->with('success', 'Permission Updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function create_permission()
    {
        return view('permissions.create_permission');
    }

    public function list_permission()
    {
        $permissionsdata = Permission::orderBy('created_at', 'desc')->get()->map(function ($permission) {
            return $permission->getOriginal(); // Get the original attributes
        })->toArray();
        return view('permissions.list_permission', compact('permissionsdata'));
    }




    public function role_permission()
    {
        $userId = Auth::user()->id;
        $permissionsdata = Permission::orderBy('created_at', 'desc')->get()->map(function ($permission) {
            return $permission->getOriginal(); // Get the original attributes
        })->toArray();

        $defaultRoles = ['Admin', 'Teacher'];

        // $role = Role::where(function ($query) use ($userId, $defaultRoles) {
        //     $query->where('user_id', $userId)
        //         ->orWhereIn('name', $defaultRoles);
        // })
        //     ->whereNotIn('name', ['Superadmin'])->latest()
        //     ->get();

        $permissions_user_list = User::where('user_id', $userId)->whereNotIn('type', ['Student', 'Superadmin'])->get();

        return view('permissions.role_permission', compact('permissionsdata', 'permissions_user_list'));
    }


    public function assignpermissions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|array',
            'role_id.*' => 'exists:users,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $userId = Auth::user()->id;
        $users = $request->role_id;
        $permissions = $request->permissions;
        foreach ($users as $assignedUserId) {
            foreach ($permissions as $permission_id) {
                $uuid = (string) Guid::uuid4();

                PermissionRole::updateOrCreate(
                    [
                        'assigned_user_id' => $assignedUserId,
                        'permission_id' => $permission_id,
                        'user_id' => $userId,
                    ],
                    [
                        'id' => $uuid
                    ]
                );
            }
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

            return redirect()->route('permissions.list')
                ->with('success', 'Permission created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }




    // public function update_permission(Request $request)
    // {
    //     $permission = Permission::findOrFail($request->id);

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
    //         'displayname' => 'required|string|max:255',
    //         'description' => 'nullable|string|max:500',
    //     ]);
    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }


    //     $permission->update([
    //         'name' => $request->name,
    //         'display_name' => $request->displayname,
    //         'description' => $request->description,
    //     ]);

    //     return redirect()->route('permissions.create')->with('success', 'Permission updated successfully!');
    // }





    public function destroy($id)
    {
        $permission = Permission::findOrfail($id);
        $permission->delete();

        return redirect()->route('permissions.list')
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
            // 'displayname' => 'required|string|max:255',
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
                // 'display_name' => $request->displayname,
                'display_name' => $request->name,
                'description' => $request->description,
            ]);


            return redirect()->route('roles.list')
                ->with('success', 'Role created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function new_submit_roles(Request $request)
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
            // 'displayname' => 'required|string|max:255',
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
                // 'display_name' => $request->displayname,
                'display_name' => $request->name,
                'description' => $request->description,
            ]);


            return redirect()->back()
                ->with('success', 'New Role created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function role_delete($id)
{
    $userId = Auth::user()->id;
    if (Gate::denies('role')) {
        return redirect()->back()->with('error', 'Unauthorized access.');
    }
    $role = Role::where('id', $id)->where('user_id', $userId)->first();
    if (!$role) {
        return redirect()->back()->with('error', 'The selected role does not exist or you do not have permission to delete it.');
    }
    try {
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}


    // public function role_delete($id)
    // {
    //     if (Gate::denies('role')) {
    //         return redirect()->back()->with('error', 'Unauthorized access.');
    //     }

    //     $role = role::find($id);
    //     if ($role) {
    //         $role->delete();
    //         return redirect()->back()->with('success', 'Role deleted successfully.');
    //     } else {
    //         return redirect()->back()->with('error', 'Role ID not found.');
    //     }
    // }

    public function permissions_assigned_list()
    {
        $userId = Auth::user()->id;
        $permissionsdata = PermissionRole::select('permission_role.id', 'permissions.name', 'permissions.display_name', 'users.name', 'users.type as userstype', 'users.email')->where('permission_role.user_id', $userId)->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')->join('users', 'users.id', '=', 'permission_role.assigned_user_id')->latest('permission_role.created_at')->get();

        return view('permissions.permissions_assigned_list', compact('permissionsdata'));
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

    public function user_assign_permission($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $allpermissions = Permission::all();
        $assignedPermissions = PermissionRole::where('assigned_user_id', $user->id)->where('user_id', Auth::user()->id)
            ->pluck('permission_id')
            ->toArray();

        return view('permissions.user_assign_permission', compact('user', 'allpermissions', 'assignedPermissions'));
    }

    public function user_assign_permissions(Request $request)
    {
        $assignuser_id = $request->user_id;
        $user_id = Auth::user()->id;
        PermissionRole::where('assigned_user_id', $assignuser_id)->where('user_id', $user_id)->delete();

        // Assign new permissions
        if ($request->has('permissions')) {
            foreach ($request->permissions as $permission_id) {
                $uuid = (string) Guid::uuid4();
                PermissionRole::create([
                    'id' => $uuid,
                    'assigned_user_id' => $assignuser_id,
                    'permission_id' => $permission_id,
                    'user_id' => $user_id,
                ]);
            }
        }

        return redirect()->route('userlist')->with('success', 'Permissions updated successfully!');
    }
}
