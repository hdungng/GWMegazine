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
        $request->validate([
            'username' => 'required|string|max:255|min:3',
            'fullname' => 'required|string|max:255|min:3',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation','password_confirmation' => 'min:8',
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
            'password' => "Password",
            'avatar' => 'Avatar',
            'faculty_id' => 'Faculty'
        ]);

        $user = User::find($id);

        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;

        if (!$user) {
            // User not found, handle the case accordingly
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        if ($request->hasFile('avatar')) {
            $avatar_file = $request->file('avatar');

            // GET FILE NAME
            $avatar_file_name = $avatar_file->getClientOriginalName();

            // UPLOAD FILE NAME
            $avatar_file->move('public/uploads/images/users', $avatar_file_name);
            $avatar = "public/uploads/images/users/" . $avatar_file_name;

            $user->avatar =  $avatar;
        }

        if ($request->has("password")) {
            $user->password = Hash::make($request->password);
        }

        $updatedUser = $user;
        $user->save();
    }

    public function update_password(Request $request, $id) {
        // Khai implementation

    }
}
