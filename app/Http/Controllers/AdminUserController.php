<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\ActivityLog;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        $users = User::select('users.*', 'roles.name AS role_name')
            ->selectRaw("CASE 
                            WHEN roles.name IN ('Student', 'Guest') THEN faculties.name 
                            ELSE coordinator_faculty.name 
                        END AS faculty_name")
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->leftJoin('faculties as coordinator_faculty', 'users.id', '=', 'coordinator_faculty.coordinator_id')
            ->orderBy('role_name', 'asc')
            ->orderBy('users.created_at', 'desc')
            ->get();

        return view('admin.users.list', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['Root'])->orderBy('created_at', 'asc')->get();
        $faculties = Faculty::all();
        $facultiesAvailable = Faculty::whereNull('coordinator_id')->get();

        return view('admin.users.create', compact('roles', 'faculties', 'facultiesAvailable'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|min:3',
            'fullname' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|string|not_in:',
            'avatar' => 'image|mimes:png,jpg,jpeg|square',
            'faculty_id' => [Rule::requiredIf(in_array($request->role_id, [UserRoleEnum::STUDENT, UserRoleEnum::GUEST])),],
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
            'email' => ":attribute is not in a valid format",
            'unique' => ":attribute already exists",
            'image' => ":attribute must be an image file in jpeg, png, bmp, or gif format",
            'square' => ":attribute must be a square image",
        ], [
            'username' => "Username",
            'fullname' => "Fullname",
            'email' => "Email",
            'password' => "Password",
            'role_id' => 'Role',
            'avatar' => 'Avatar',
            'faculty_id' => 'Faculty'
        ]);

        if ($request->hasFile('avatar')) {
            $avatar_file = $request->file('avatar');

            // GET FILE NAME
            $avatar_file_name = $avatar_file->getClientOriginalName();

            // UPLOAD FILE NAME
            $avatar_file->move('public/uploads/images/users', $avatar_file_name);
            $avatar = "public/uploads/images/users/" . $avatar_file_name;
        } else {
            $avatar = "public/uploads/images/users/default-user.jpg";
        }

        $user = new User();
        $user->id = Str::uuid();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->avatar =  $avatar;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->faculty_id = $request->has('faculty_id') &&
            $request->role_id != UserRoleEnum::COORDINATOR
            ? $request->faculty_id : null;

        $userSavedId = $user->id;
        $userSavedName = $user->username;

        $user->save();

        if ($request->role_id == UserRoleEnum::COORDINATOR) {
            // 
            if ($request->has('faculty_id')) {

                if (!empty($request->faculty_id)) {
                    $faculty = Faculty::find($request->faculty_id);

                    if ($faculty) {
                        $faculty->coordinator_id = $userSavedId;

                        $facultyAssigned = $faculty;
                        $faculty->save();

                        ActivityLog::create([
                            'id' => Str::uuid(),
                            'content' => 'Assign ' . $userSavedName .  ' to ' . $facultyAssigned->name . ' successfully!',
                            'user_id' => Auth::user()->id,
                        ]);
                    }
                }
            }
        }


        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'User ' . $userSavedName . ' created successfully!',
            'user_id' => Auth::user()->id,
        ]);
        toastr()->success('User created successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            // User not found, handle the case accordingly
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $roles = Role::whereNotIn('name', ['Root'])->orderBy('created_at', 'asc')->get();
        $faculties = Faculty::all();
        $facultiesAvailable = Faculty::whereNull('coordinator_id')
            ->orWhere('coordinator_id', $user->id)
            ->get();

        return view('admin.users.edit', compact('user', 'roles', 'faculties', 'facultiesAvailable'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255|min:3',
            'fullname' => 'required|string|max:255|min:3',
            $request->filled('password') ? 'required|string|min:8' : '',
            'avatar' => 'image|mimes:png,jpg,jpeg|square',
            'faculty_id' => [Rule::requiredIf(in_array($request->role_id, [UserRoleEnum::STUDENT, UserRoleEnum::GUEST])),],
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

        if (!$user) {
            // User not found, handle the case accordingly
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->faculty_id = $request->has('faculty_id') &&
            $request->role_id != UserRoleEnum::COORDINATOR
            ? $request->faculty_id : null;

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

        if ($updatedUser->role_id == UserRoleEnum::COORDINATOR) {
            // 
            if ($request->has('faculty_id')) {

                if (empty($request->faculty_id)) {
                    $facultyPrevious = Faculty::where('coordinator_id', '=', $updatedUser->id)->first();
                    if ($facultyPrevious) {
                        $facultyPrevious->coordinator_id = null;
                        $facultyPrevious->save();
                    }
                    ActivityLog::create([
                        'id' => Str::uuid(),
                        'content' => 'Unassign ' . $updatedUser->username .  ' to ' . $facultyPrevious->name . ' successfully!',
                        'user_id' => Auth::user()->id,
                    ]);
                    toastr()->success('User updated successfully!', 'Success', ['timeOut' => 5000]);
                    return redirect()->route('admin.users.index');
                }

                $faculty = Faculty::find($request->faculty_id);

                if ($faculty->coordinator_id != $id) {
                    $facultyPrevious = Faculty::where('coordinator_id', '=', $updatedUser->id)->first();

                    if ($facultyPrevious) {
                        $facultyPrevious->coordinator_id = null;
                        $facultyPrevious->save();
                    }

                    $faculty->coordinator_id = $id;
                    $facultyAssigned = $faculty;
                    $faculty->save();
                    ActivityLog::create([
                        'id' => Str::uuid(),
                        'content' => 'Assign ' . $updatedUser->username .  ' to ' . $facultyAssigned->name . ' successfully!',
                        'user_id' => Auth::user()->id,
                    ]);
                }
            }
        }

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'User ' . $user->username . ' updated successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('User updated successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.users.index');
    }

    public function delete(Request $request)
    {
        $user = User::find($request->userIdDelete);

        if (!$user) {
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        if ($user->id == Auth::user()->id) {
            toastr()->error('You cannot remove yourself!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $deletedUser = $user;
        $user->delete();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'User ' .  $deletedUser->username  . ' deleted successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('User deleted successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.users.index');
    }
}
