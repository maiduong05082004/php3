<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function NotFound()
    {
        return view('admin.404');
    }
}
