<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    //
    public function index()
    {
        return view("admin.user-profile");
    }

    public function update_info(Request $request, $id) {
        // Khai implementation
    }

    public function update_password(Request $request, $id) {
        // Khai implementation

    }
}
