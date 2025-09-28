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
	public function userRoles(Request $request)
	{
		$data['roles'] = Role::all();
		$roleName = $request->query('role_name');
	
		if ($roleName) {
			$selectedRole = Role::where('name', $roleName)->first();
			$users = $selectedRole ? $selectedRole->users()->with('roles')->get() : collect(); 
			// empty if role not found
		} else {
			$users = User::with('roles')->get();
			$selectedRole = null;
		}

		$data['users'] = $users;

		return view('role-permission.user-role', $data);
	}

	public function assignRole(Request $request)
	{
		$request->validate([
			'user_id' => 'required|exists:users,id',
			'role_id' => 'required|exists:roles,id',
		]);

		$user = User::find($request->user_id);
		$user->roles()->sync([$request->role_id]);

		return back()->with('success', 'Role assigned successfully');
	}
	
	// Role
	public function roles()
	{
		$data['roles'] = Role::with('permissions')->get();
		return view('role-permission.roles', $data);
	}

	public function storeRole(Request $request)
	{
		$request->validate(['name' => 'required|unique:roles,name']);

		Role::insert(['name' => $request->name]);
		return back()->with('success', 'Role created successfully');
	}
	
	// Parmission
	public function editPermissions(Role $role)
	{
		$data['role'] = $role;
		$data['categories'] = PermissionCategory::with('permissions')->get();
		$data['rolePermissions'] = $role->permissions->pluck('id')->toArray();

		return view('role-permission.edit-permissions', $data);
	}

	public function updatePermissions(Request $request, Role $role)
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

		return response()->json(['message' => 'Permission updated successfully']);
	}

	// Permissions	
	public function permissions()
	{
		$data['categories'] = PermissionCategory::all();
		return view('role-permission.permissions', $data);
	}

	public function storePermissionCategory(Request $request)
	{
		$request->validate(['permission_category' => 'required|unique:permission_categories,name']);

		PermissionCategory::insert(['name' => $request->permission_category]);
		return back()->with('success', 'Permission category created successfully');
	}

	public function storePermission(Request $request)
	{
		$request->validate([
			'permission' => 'required|string',
			'permission_category_id' => 'required|exists:permission_categories,id',
		]);

		// Normalize permission: lowercase + replace spaces with underscores
		$normalizedPermission = strtolower(preg_replace('/\s+/', '_', $request->permission));

		// Prevent duplicate permission in same category
		$exists = Permission::where('name', $normalizedPermission)
			->where('permission_category_id', $request->permission_category_id)
			->exists();

		if ($exists) {
			return back()->withErrors(['permission' => 'This permission already exists in this category']);
		}

		Permission::insert([
			'name' => $normalizedPermission,
			'permission_category_id' => $request->permission_category_id,
		]);

		return back()->with('success', 'Permission created successfully');
	}
}