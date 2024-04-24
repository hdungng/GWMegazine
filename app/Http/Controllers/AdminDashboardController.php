<?php

namespace App\Http\Controllers;

use App\CustomClass\ContributionFacultyChart;
use App\CustomClass\BarChart;
use App\CustomClass\CoordinatorContributionFacultyChart;
use App\Enums\AcademicYearStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\AcademicYear;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminDashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();

        $academicYears = AcademicYear::all();

        $selectedAcademicYear = $request->academic_year_id ? AcademicYear::find($request->academic_year_id) : $currentAcademicYear;

        if (Auth::user()->role_id == UserRoleEnum::ADMIN) {
            return redirect()->route('admin.users.index');
        } else if (Auth::user()->role_id == UserRoleEnum::MANAGER) {
            $chart1 = new ContributionFacultyChart();
            // MANAGER: CHART 1
            $totalContributionsEachFaculty = DB::table('users')
                ->select(DB::raw('count(users.id) as total_contributions'))
                ->join('contributions', 'users.id', '=', 'contributions.user_id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->whereIn('faculties.short_name', $chart1->facultyNames)
                ->where('contributions.academic_year_id', '=', $selectedAcademicYear->id)
                ->groupBy('faculty_id')
                ->pluck('total_contributions')
                ->toArray();

            $chart1->datasets = $totalContributionsEachFaculty;

            // MANAGER: CHART 2
            $chart2 = new ContributionFacultyChart();

            $totalStudentsEachFaculty = DB::table('users')
                ->select(DB::raw('count(distinct(users.id)) as total_students'))
                ->join('contributions', 'users.id', '=', 'contributions.user_id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->whereIn('faculties.short_name', $chart2->facultyNames)
                ->where('contributions.academic_year_id', '=', $selectedAcademicYear->id)
                ->groupBy('faculty_id')
                ->pluck('total_students')
                ->toArray();

            $chart2->datasets = $totalStudentsEachFaculty;

            // Chart 3: Contribution of Academic Year
            $contributionsAcademicYears = DB::table('contributions')
                ->select(
                    'academic_years.name as academic_year', // Assuming 'name' field in Academic Year table
                    'faculties.short_name as faculty_name',
                    'faculties.chart_color as color',
                    DB::raw('count(*) as contribution_count')
                )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('academic_years', 'contributions.academic_year_id', '=', 'academic_years.id') // Join with Academic Year table
                ->groupBy('academic_years.id', 'faculties.id')
                ->get();


            $transformedData = [];

            // Group by faculty_name and accumulate contributions per academic year
            foreach ($contributionsAcademicYears as $item) {
                $facultyName = $item->faculty_name;
                $color = $item->color;
                $academicYear = $item->academic_year;

                if (!isset($transformedData[$facultyName])) {
                    $transformedData[$facultyName] = [
                        "label" => $facultyName,
                        "borderColor" => $color,
                        "backgroundColor" => $color,
                        "data" => [],
                        "tension" => 0.1,
                        "fill" => false
                    ];
                }

                if (!isset($transformedData[$facultyName]["data"][$academicYear])) {
                    $transformedData[$facultyName]["data"][$academicYear] = 0;
                }
                $transformedData[$facultyName]["data"][$academicYear] += $item->contribution_count ?? 0;
            }

            $new_data = array_values($transformedData);

            // Convert data to numeric indexes
            foreach ($new_data as &$dataset)
                $dataset['data'] = array_values($dataset['data']);


            $chart3 = new BarChart($new_data);
        } else {

            $currentFaculty = Faculty::select(
                'faculties.*',
                'users.id AS faculty_id'
            )->join('users', 'users.id', '=', 'faculties.coordinator_id')
                ->where('faculties.coordinator_id', Auth::user()->id)->first();



            if (!$currentFaculty) {
                toastr()->error('This coordinator is not assigned any faculties!', 'Error', ['timeOut' => 5000]);
                return route('admin.contributions.index');
            }

            // Chart 1
            $submittedStudents = User::select(DB::raw('count(distinct(users.id)) as total_students'))
                ->join('contributions', 'users.id', '=', 'contributions.user_id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->where('faculties.id', '=', $currentFaculty->id)
                ->where('users.role_id', '=', UserRoleEnum::STUDENT)
                ->where('contributions.academic_year_id', '=', $selectedAcademicYear->id)
                ->first()
                ->total_students;


            $unsubmittedStudents = User::where('users.role_id', '=', UserRoleEnum::STUDENT)
                ->where('faculty_id', '=', $currentFaculty->id)
                ->count() - $submittedStudents;


            $chart1 = new CoordinatorContributionFacultyChart();
            $chart1->labels = ['Submitted', 'Not Submitted'];
            $chart1->datasets = [
                $submittedStudents,
                $unsubmittedStudents
            ];

            // Chart 2
            $contributionsWithComments = DB::table('contributions')
                ->join('comments', 'contributions.id', '=', 'comments.contribution_id')
                ->join('users', 'users.id', '=', 'contributions.user_id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->where('faculties.id', '=', $currentFaculty->id)
                ->where('contributions.academic_year_id', '=', $selectedAcademicYear->id)
                ->distinct('contributions.id')
                ->count();


            $contributionsWithoutComments = DB::table('contributions')
                ->leftJoin('comments', 'contributions.id', '=', 'comments.contribution_id')
                ->join('users', 'users.id', '=', 'contributions.user_id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->where('faculties.id', '=', $currentFaculty->id)
                ->where('contributions.academic_year_id', '=', $selectedAcademicYear->id)
                ->whereNull('comments.contribution_id')
                ->distinct('contributions.id')
                ->count();

            $chart2 = new CoordinatorContributionFacultyChart();
            $chart2->labels = ['With Comment', 'Without Comments'];
            $chart2->datasets = [
                $contributionsWithComments,
                $contributionsWithoutComments
            ];


            // Chart 3: Contribution of Academic Year
            $contributionsAcademicYears = DB::table('academic_years')
                ->join('contributions', 'contributions.academic_year_id', '=', 'academic_years.id')
                ->join('users', 'users.id', '=', 'contributions.user_id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->select(DB::raw('count(*) as total_contributions'))
                ->where('faculties.id', $currentFaculty->id)
                ->groupBy('academic_years.name')
                ->pluck('total_contributions')->toArray();

            $chart3 = new BarChart($contributionsAcademicYears);
        }

        return view('admin.dashboard', compact('chart1', 'chart2', 'chart3', 'selectedAcademicYear', 'academicYears'));
    }
}
