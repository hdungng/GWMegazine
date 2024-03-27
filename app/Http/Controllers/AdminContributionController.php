<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminContributionController extends Controller
{
    //
    public function index()
    {
        return view('admin.contributions.list');
    }

    public function detail() {
        return view('admin.contributions.detail');
    }

    public function edit() {
        return view('admin.contributions.edit');
    }

    public function preview() {
        return view('admin.contributions.preview');
    }
}
