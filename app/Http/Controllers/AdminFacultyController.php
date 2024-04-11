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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminFacultyController extends Controller
{
    //
    public function index()
    {
        $faculties =  Faculty::select('faculties.*', 'users.fullname AS coordinator_name')
            ->leftJoin('users', 'faculties.coordinator_id', '=', 'users.id')
            ->orderBy('created_at', 'desc')
            ->get();

        $coordinatorsAvailable = User::select('users.*', 'faculties.coordinator_id')
            ->leftJoin('faculties', 'users.id', '=', 'faculties.coordinator_id')
            ->where('role_id', '=', UserRoleEnum::COORDINATOR)
            ->whereNull('faculties.coordinator_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.faculties.overview', compact('coordinatorsAvailable', 'faculties'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|min:3|unique:faculties',
            'short_name' => 'required|string|max:255|min:2|unique:faculties',
            'chart_color' => 'required|unique:faculties|not_in:#000000',
            'coordinator_id' => '',
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
            'not_in' => ":attribute must be different from #000000",
        ], [
            'name' => "Faculty name",
            'short_name' => 'Faculty short name',
            'coordinator_id' => 'Coordinator',
            'chart_color' => 'Chart color'
        ]);

        $faculty = new Faculty();

        $faculty->id = Str::uuid();
        $faculty->name = $request->name;
        $faculty->short_name = $request->short_name;
        $faculty->chart_color = $request->chart_color;
        $faculty->coordinator_id = $request->coordinator_id;

        // Save the Faculty instance to the database
        $faculty->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Faculty '  . $request->name  . ' ('  . $request->short_name  . ') created successfully!',
            'user_id' => Auth::user()->id,
        ]);
        toastr()->success('Faculty created successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.faculty.index');
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:255', 'min:3', Rule::unique('faculties')->ignore($request->name),
            'short_name' => 'required', 'string', 'min:2', 'max:255', Rule::unique('faculties')->ignore($request->short_name),
            'chart_color' => 'required|not_in:#000000', Rule::unique('faculties')->ignore($request->chart_color),
            'coordinator_id' => '',
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
            'not_in' => ":attribute must be different from #000000",
        ], [
            'name' => "Faculty name",
            'short_name' => 'Faculty short name',
            'chart_color' => 'Faculty short name',
            'coordinator_id' => 'Coordinator'
        ]);

        if ($validator->fails()) {
            $errorMessage = '';
            foreach ($validator->errors()->all() as $error) {
                $errorMessage .= '- ' . $error . '<br>';
            }
            toastr()->error($errorMessage, 'Error', ['timeOut' => 5000]);
            return back();
        }

        $faculty = Faculty::find($request->facultyIdEdit);

        if (!$faculty) {
            // Faculty not found, handle the case accordingly
            toastr()->error('Faculty is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $faculty->name = $request->name;
        $faculty->short_name = $request->short_name;
        $faculty->chart_color = $request->chart_color;

        if (empty($request->coordinator_id)) {
            $faculty->coordinator_id = null;
        } else {
            $faculty->coordinator_id = $request->coordinator_id;
        }

        $faculty->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Faculty '  . $request->name  . ' ('  . $request->short_name  . ') created successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Faculty updated successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.faculty.index');
    }

    public function delete(Request $request)
    {
        $faculty = Faculty::find($request->facultyIdDelete);

        if (!$faculty) {
            toastr()->error('Faculty is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $userExisting = User::where('faculty_id', '=', $faculty->id)->first();

        if ($userExisting) {
            toastr()->error('Cannot delete this faculty due to currently existing users.', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $facultyNameSaved = $faculty->name;

        $faculty->delete();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Faculty ' .   $facultyNameSaved  . ' deleted successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Faculty deleted successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.faculty.index');
    }
}
