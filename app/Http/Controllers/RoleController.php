<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionCategory;

class RoleController extends Controller
{
	// User role
	public function userRole2(Request $request)
	{
		$roles = Role::all();
		$roleId = $request->query('role_id');

		if ($roleId) {
			$users = User::whereHas('roles', function ($q) use ($roleId) {
				$q->where('roles.id', $roleId);
			})->with('roles')->get();

			$selectedRole = Role::find($roleId);
		} else {
			$users = User::with('roles')->get();
			$selectedRole = null;
		}

		return view('role-permission.user-role', compact('users', 'roles', 'selectedRole'));
	}

	public function userRole(Request $request)
	{
		$roles = Role::all();
		$roleName = $request->query('role_name');

		if ($roleName) {
			$selectedRole = Role::where('name', $roleName)->first();
			$users = $selectedRole
				? $selectedRole->users()->with('roles')->get()
				: collect(); // empty if role not found
		} else {
			$users = User::with('roles')->get();
			$selectedRole = null;
		}

		return view('role-permission.user-role', compact('users', 'roles', 'selectedRole'));
	}



	public function assignRole(Request $request)
	{
		$request->validate([
			'user_id' => 'required|exists:users,id',
			'role_id' => 'required|exists:roles,id',
		]);

		$user = User::find($request->user_id);
		$user->roles()->sync([$request->role_id]);

		return redirect()->route('role.userRole')->with('success', 'Role assigned successfully.');
	}

	// Role
	public function roles()
	{
		$data['roles'] = Role::with('permissions')->get();
		return view('role-permission.roles', $data);
	}

	public function roleCreate(Request $request)
	{
		$request->validate(['name' => 'required|unique:roles,name']);

		Role::insert(['name' => $request->name]);
		return redirect()->route('roles.index')->with('success', 'Role created successfully');
	}

	// Parmission
	public function editPermissions(Role $role)
	{
		$data['role'] = $role;
		$data['categories'] = PermissionCategory::with('permissions')->get();
		$data['rolePermissions'] = $role->permissions->pluck('id')->toArray();

		return view('role-permission.edit-permissions', $data);
	}

	public function updatePermission(Request $request, Role $role)
	{
		$request->validate([
			'permission_id' => 'required|exists:permissions,id',
			'checked'       => 'required|boolean',
		]);

		if ($request->checked) {
			// attach if not already
			if (!$role->permissions->contains($request->permission_id)) {
				$role->permissions()->attach($request->permission_id);
			}
		} else {
			// detach
			$role->permissions()->detach($request->permission_id);
		}

		return response()->json(['message' => 'Permission updated successfully.']);
	}

	// Permissions	
	public function permissions()
	{
		$data['categories'] = PermissionCategory::all();
		return view('role-permission.permissions', $data);
	}

	public function permission_category(Request $request)
	{
		$request->validate(['permission_category' => 'required|unique:permission_categories,name']);

		PermissionCategory::insert(['name' => $request->permission_category]);
		return back()->with('success', 'Permission category created successfully.');
	}

	public function permissionStore(Request $request)
	{
		$request->validate([
			'permission' => 'required|string',
			'permission_category_id' => 'required|exists:permission_categories,id',
		]);

		// Prevent duplicate permission in same category
		$exists = Permission::where('name', $request->permission)
			->where('permission_category_id', $request->permission_category_id)
			->exists();

		if ($exists) {
			return back()->withErrors(['name' => 'This permission already exists in this category']);
		}

		Permission::insert([
			'name' => $request->permission,
			'permission_category_id' => $request->permission_category_id,
		]);

		return redirect()->back()->with('success', 'Permission created successfully!');
	}
}
