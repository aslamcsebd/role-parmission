<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
                'link'  => url('title-1'),
                'value' => User::count(),
                'title' => 'Title 1'
            ],
            [
                'link'  => route('home'),
                'value' => User::count(),
                'title' => 'Title 2'
            ],
            [
                'link'  => url('title-3'),
                'value' => User::count(),
                'title' => 'Title 3'
            ],
        ];

        return view('home', $data);
    }

    public function auth()
    {
        return view('loginForm.auth');
    }
}