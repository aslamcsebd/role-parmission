<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionCategory;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['types'] = [
            [
                'link'  => route('user_roles.index'),
                'value' => User::count(),
                'title' => 'Total user'
            ],
            [
                'link'  => route('roles.index'),
                'value' => Role::count(),
                'title' => 'Total role'
            ],
            [
                'link'  => route('permissions.index'),
                'value' => PermissionCategory::count(),
                'title' => 'Total Permission Category'
            ],
			[
                'link'  => route('permissions.index'),
                'value' => Permission::count(),
                'title' => 'Total Permission'
            ],
        ];

        return view('home', $data);
    }

    public function auth()
    {
        return view('loginForm.auth');
    }
}