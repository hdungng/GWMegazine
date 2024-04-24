<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\AcademicYearStatusEnum;
use App\Models\AcademicYear;
use Carbon\Carbon;

class HomeProfileController extends Controller
{
    //
    public $startingDateOpen;

    public function __construct()
    {
        $currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();
        $currentDateTime = Carbon::now();

        if ($currentDateTime->gt($currentAcademicYear->starting_date)) {
            $this->startingDateOpen = true;
        } else {
            $this->startingDateOpen = false;
        }
    }

    function index()
    {
        return view("home.user-profile", [
            'startingDateOpen' => $this->startingDateOpen,
        ]);
    }

    function update_info(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255|min:3',
            'fullname' => 'required|string|max:255|min:3',
            'avatar' => 'image|mimes:png,jpg,jpeg|square',
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
            'unique' => ":attribute already exists",
            'image' => ":attribute must be an image file in jpeg, png, bmp, or gif format",
            'square' => ":attribute must be a square image",
        ], [
            'username' => "Username",
            'fullname' => "Fullname",
            'avatar' => 'Avatar',
        ]);

        $user = User::find($id);

        if ($user) {
            $user->username = $request->username;
            $user->fullname = $request->fullname;

            if ($request->hasFile('avatar')) {
                $avatar_file = $request->file('avatar');

                // GET FILE NAME
                $avatar_file_name = $avatar_file->getClientOriginalName();

                // UPLOAD FILE NAME
                $avatar_file->move('public/uploads/images/users', $avatar_file_name);
                $avatar = "public/uploads/images/users/" . $avatar_file_name;
                $user->avatar = $avatar;
            }
        } else {
            // User not found, handle the case accordingly
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'User ' . $request->username . ' update profile successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Update your profile successfully!', 'Success', ['timeOut' => 5000]);
        $user->save();
        return redirect()->route('home.user-profile', Auth::user()->id);
    }

    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'confirmed' => "The passwords you entered do not match",
        ], [
            'password' => "Password",
        ]);

        $user = User::find($id);

        if (!$user) {
            // User not found, handle the case accordingly
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'User ' . $request->username . ' update password successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Update your password successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('home.user-profile', Auth::user()->id);
    }
}
