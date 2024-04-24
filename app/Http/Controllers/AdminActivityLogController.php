<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminActivityLogController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->id === UserRoleEnum::ADMIN) {
            # code...
            $activityLogs = ActivityLog::orderBy("created_at", "desc")->get();
        } else if (Auth::user()->role->id === UserRoleEnum::MANAGER) {
            # code...
            $activityLogs = ActivityLog::join('users', 'users.id', '=', 'activity_logs.user_id')
                ->where('users.role_id', UserRoleEnum::COORDINATOR)
                ->orWhere('users.role_id', UserRoleEnum::STUDENT)
                ->where('activity_logs.content', 'not like', 'User % update profile successfully!')
                ->orderBy("activity_logs.created_at", "desc")
                ->get();
        }

        return view('admin.activity-logs.list', compact('activityLogs'));
    }
}
