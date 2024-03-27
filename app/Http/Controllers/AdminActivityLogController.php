<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminActivityLogController extends Controller
{
    //
    public function index()
    {
        $activityLogs = ActivityLog::orderBy("created_at","desc")->get();

        return view('admin.activity-logs.list', compact('activityLogs'));
    }
}
