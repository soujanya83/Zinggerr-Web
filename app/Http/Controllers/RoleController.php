<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Show create form

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
    public function create()
    {
        return view('roles.create');
    }

    // Store a new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'user_display' => 'required',
            'description' => 'nullable|string',
        ]);

        Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    // Show edit form
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Update an existing role
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'user_display' => 'required',
            'description' => 'nullable|string',
        ]);

        $role->update([
            'name' => $request->name,
            'userdisplay' => $request->userdisplay,
            'description' => $request->description,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }

   
}
