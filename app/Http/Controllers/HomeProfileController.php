<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeProfileController extends Controller
{
    //
    function index() {
        return view("home.user-profile");
    }

    function update_info(Request $request, $id) {
        // Khai implementation
    }

    public function update_password(Request $request, $id) {
        // Khai implementation
    }
}
