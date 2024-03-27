<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminRolePermissionController extends Controller
{
    //
    public function index()
    {
        return view('admin.role-permissions.overview');
    }
}
