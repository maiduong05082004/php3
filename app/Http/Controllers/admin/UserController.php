<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

}
