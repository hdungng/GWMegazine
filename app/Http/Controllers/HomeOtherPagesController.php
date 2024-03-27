<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeOtherPagesController extends Controller
{
    //
    function content_policy() {
        return view("home/others/content-policy");
    }

    function user_agreement() {
        return view("home/others/user-agreement");
    }

    function help() {
        return view("home/others/help");
    }
}
