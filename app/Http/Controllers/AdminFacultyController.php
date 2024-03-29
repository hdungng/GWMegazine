<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Faculty;
use Illuminate\Support\Str;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRoleEnum;

class AdminFacultyController extends Controller
{
    //
    public function index()
    {
        $faculties = Faculty::all();
        $coordinatorsAvailable = User::where('role_id', [UserRoleEnum::COORDINATOR])
        ->whereNull('faculty_id')
        ->get();
        return view('admin.faculties.overview', compact('coordinatorsAvailable', 'faculties'));
    }

    public function store(Request $request) {
        // Khai implementation
        //$coordinatorsAvailable = User::whereHas('200e9da4-e7e8-11ee-b3b3-dc21486e292b', function($query) {$query->whereDoesntHave('faculty_id');})->get();

        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'short_name' => 'required|string|max:255|min:3',
            'coordinator_id' =>'string',
            
            //['string', Rule::requiredIf(in_array($request->coordinator_id)),],
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
        ], [
            'name' => "Faculty name",
            'short_name' => 'Faculty short name',
            'coordinator_id' => 'Coordinator'
        ]);

        $faculty = new Faculty();
        $faculty->id = Str::uuid();
        $faculty->name = $request->name;
        $faculty->short_name = $request->short_name;
        $faculty->coordinator_id = $request->coordinator_id;

        $facultySavedName = $faculty->name;
        $facultySaveShortName = $faculty->short_name;
        // Save the Faculty instance to the database
        $faculty->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Faculy '  . $facultySavedName  . ' ('  .$facultySaveShortName  . ') created successfully!',
            'user_id' => Auth::user()->id,
        ]);
        toastr()->success('Faculty created successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.faculty.index');
    }

    public function update(Request $request) {
        // Khai implementation
        $request->validate([
            'name' => 'required|string|unique:faculty_name|max:255',
            'short_name' => 'required|string|unique:faculty_short_name',
            'coordinator_id' => ['string', Rule::requiredIf(function($request) { return $request->coordinator_id === 'available';}),],
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
        ], [
            'name' => "Faculty name",
            'short_name' => 'Faculty short name',
            'coordinator_id' => 'Coordinator'
        ]);

        $faculty = Faculty::find($id);

        if (!$faculty) {
            // Faculty o found, handle the case accordingly
            toatsr()->error('Faculty is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $faculty->name = $request->name;
        $faculty->short_name = $request->short_name;
        $faculty->coordinator_id = $request->coordinator_id;

        $updatedFaculty = $faculty;
        $faculty->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Faculty ' . $faculty->name . ' updated successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Faculty updated successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.faculty.index');
    }

    public function delete(Request $request) {
        // Khai implementation
        $faculty = Faculty::find($request->facultyIdDelete);

        if (!$faculty) {
            toastr()->error('Faculty is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $deletedFaculty = $faculty;
        $faculty->delete();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Faculty ' .  $deletedFaculty->name  . ' deleted successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Faculty deleted successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.faculty.index');
    }
}
