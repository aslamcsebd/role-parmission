<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/auth', [HomeController::class, 'auth'])->name('auth');

Route::controller(RoleController::class)->group(function () {
	// --- User Roles (assigning roles to users) ---
	Route::get('user-roles', 'userRoles')->name('user_roles.index');
	Route::post('user-roles/assign', 'assignRole')->name('user_roles.assign');
	
	// Roles
	Route::get('roles', 'roles')->name('roles.index');
	Route::post('roles', 'storeRole')->name('roles.store');
	Route::get('roles/{role}/edit-permissions', 'editPermissions')->name('roles.edit_permissions');
	Route::post('roles/{role}/update-permission', 'updatePermissions')->name('roles.update_permissions');
    // Route::put('roles/{role}/permissions', 'updatePermissions');
	
	// --- Permission Categories ---
    Route::post('permission-categories', 'storePermissionCategory')->name('permission_categories.store');

	//Permissions
	Route::get('permissions', 'permissions')->name('permissions.index');
	Route::post('permissions', 'storePermission')->name('permissions.store');
});