<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class HomeOtherPagesController extends Controller
{
    //
    public $faculties;


    public function __construct()
    {
        $this->faculties = Faculty::orderBy('created_at', 'desc')->get();
    }

    function content_policy()
    {
        return view("home/others/content-policy", [
            'faculties' => $this->faculties
        ]);
    }

    function user_agreement()
    {
        return view("home/others/user-agreement", [
            'faculties' => $this->faculties
        ]);
    }

    function help()
    {
        return view("home/others/help", [
            'faculties' => $this->faculties
        ]);
    }
}
