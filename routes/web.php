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



// User role
Route::get('user-role', [RoleController::class, 'userRole'])->name('role.userRole');
Route::post('assign-role', [RoleController::class, 'assignRole'])->name('role.assignRole');

// Roles
Route::get('roles', [RoleController::class, 'roles'])->name('roles.index');
Route::post('roles/create', [RoleController::class, 'roleCreate'])->name('roles.create');
Route::get('roles/{role}/edit-permissions', [RoleController::class, 'editPermissions'])->name('roles.editPermissions');
Route::post('roles/{role}/update-permission', [RoleController::class, 'updatePermission']);

//Permissions
Route::get('/permissions', [RoleController::class, 'permissions']);
Route::post('permission_category/store', [RoleController::class, 'permission_category'])->name('permission_category.store');
Route::post('permissions/store', [RoleController::class, 'permissionStore'])->name('permissions.store'); 