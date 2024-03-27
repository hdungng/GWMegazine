<?php

namespace App\Http\Controllers;

use App\Enums\AcademicYearStatusEnum;
use App\Models\AcademicYear;
use App\Models\ActivityLog;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminAcademicYearController extends Controller
{
    //
    public function index()
    {
        $academicYears = AcademicYear::orderBy("created_at", "desc")->get();

        return view('admin.academic-years.overview', compact('academicYears'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|unique:academic_years|max:255',
            'closure_date' => 'required|date',
            'final_closure_date' => 'required|date|after:closure_date',
        ], [
            'required' => ":attribute is required",
            'max' => ":attribute must be at most :max characters long",
            'unique' => ":attribute already exists",
            'final_closure_date.after' => 'The final closure date must be after the closure date.',
        ], [
            'name' => "Academic year name",
            'closure_date' => 'Closure date',
            'final_closure_date' => 'Final closure date'
        ]);

        $closure_date = DateTime::createFromFormat('F d, Y H:i:s', $request->closure_date)
            ->format('Y-m-d H:i:s');

        $final_closure_date = DateTime::createFromFormat('F d, Y H:i:s', $request->final_closure_date)
            ->format('Y-m-d H:i:s');

        $academicYearModel = new AcademicYear();
        $academicYearModel->id = Str::uuid();
        $academicYearModel->name = $request->name;
        $academicYearModel->closure_date = $closure_date;
        $academicYearModel->final_closure_date = $final_closure_date;
        $academicYearModel->status = AcademicYearStatusEnum::NOT_SELECTED;

        $academicYearSavedName = $academicYearModel->name;
        // Save the AcademicYear instance to the database
        $academicYearModel->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Academic Year '  . $academicYearSavedName  . ' created successfully!',
            'user_id' => Auth::user()->id,
        ]);
        toastr()->success('Academic Year created successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.academic-year.index');
    }

    public function update(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:255', Rule::unique('academic_years')->ignore($request->name),
            'closure_date' => 'required|date',
            'final_closure_date' => 'required|date|after:closure_date',
        ], [
            'required' => ":attribute is required",
            'max' => ":attribute must be at most :max characters long",
            'unique' => ":attribute already exists",
            'final_closure_date.after' => 'The final closure date must be after the closure date.',
        ], [
            'name' => "Academic year name",
            'closure_date' => 'Closure date',
            'final_closure_date' => 'Final closure date'
        ]);

        if( $validator->fails() ){
            $errorMessage = '';
            foreach( $validator->errors()->all() as $error ){
                $errorMessage .= '- ' . $error . '<br>';
            }
            toastr()->error($errorMessage, 'Error', ['timeOut' => 5000]);
            return back();
        }

        $closure_date = DateTime::createFromFormat('F d, Y H:i:s', $request->closure_date)
            ->format('Y-m-d H:i:s');

        $final_closure_date = DateTime::createFromFormat('F d, Y H:i:s', $request->final_closure_date)
            ->format('Y-m-d H:i:s');

        $academicYearModel = AcademicYear::find($request->academicYearId);

        if (!$academicYearModel) {
            // User not found, handle the case accordingly
            toastr()->error('Academic is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $academicYearModel->name = $request->name;
        $academicYearModel->closure_date = $closure_date;
        $academicYearModel->final_closure_date = $final_closure_date;
        $academicYearModel->save();


        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Academic Year '  . $academicYearModel->name  . ' updated successfully!',
            'user_id' => Auth::user()->id,
        ]);
        toastr()->success('Academic Year updated successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.academic-year.index');
    }

    public function delete(Request $request)
    {
        $academicYearModel = AcademicYear::find($request->academicYearIdDelete);

        if (!$academicYearModel) {
            toastr()->error('User is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $deletedAcademicYear = $academicYearModel;
        $academicYearModel->delete();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Academic Year ' .  $deletedAcademicYear->name  . ' deleted successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Academic Year deleted successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.academic-year.index');
    }

    public function changeStatus(Request $request)
    {
        $academicYearActive = AcademicYear::find($request->academicYearIdForStatus);

        // Academic Year Previous Active
        $academicPreviousActive = AcademicYear::where('status', '=', 1)->first();

        if ($academicPreviousActive) {
            $academicPreviousActive->status = AcademicYearStatusEnum::NOT_SELECTED;
            $academicPreviousActive->save();
        }

        $academicYearActive->status = AcademicYearStatusEnum::SELECTED;
        $academicYearActive->save();


        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Academic Year ' .  $academicYearActive->name  . ' selected successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Academic Year selected successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.academic-year.index');
    }
}
