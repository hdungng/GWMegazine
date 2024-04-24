<?php

namespace App\Http\Controllers;

use App\Enums\AcademicYearStatusEnum;
use App\Enums\ContributionStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\AcademicYear;
use App\Models\Contribution;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public $startingDateOpen;

    public $faculties;


    public function __construct()
    {
        $currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();
        $currentDateTime = Carbon::now();

        if ($currentDateTime->gt($currentAcademicYear->starting_date)) {
            $this->startingDateOpen = true;
        } else {
            $this->startingDateOpen = false;
        }
        $this->faculties = Faculty::orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->role_id !=  UserRoleEnum::GUEST) {
                $contributions = Contribution::with('likes')
                    ->select('contributions.*', 'users.username AS student_name')
                    ->join('users', 'contributions.user_id', '=', 'users.id')
                    ->whereNotIn('contributions.status', [ContributionStatusEnum::PENDING, ContributionStatusEnum::PUBLISHED_FOR_GUEST])
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate(15);
            } else {
                $contributions = Contribution::with('likes')->select('contributions.*', 'users.username AS student_name')
                    ->join('users', 'contributions.user_id', '=', 'users.id')
                    ->where('users.faculty_id', '=', Auth::user()->faculty->id)
                    ->where('status', '=', ContributionStatusEnum::PUBLISHED_FOR_GUEST)
                    ->orWhere('status', '=', ContributionStatusEnum::PUBLISHED_ALL)
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate(15);
            }
        } else {
            return redirect()->route('login');
        }

        return view('home.main-page',  [
            'contributions' => $contributions,
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties
        ]);
    }

    public function detail($id)
    {
        $contribution = Contribution::select(
            'contributions.*',
            'users.username AS student_name',
        )
            ->join('users', 'contributions.user_id', '=', 'users.id')
            ->where('contributions.id', '=', $id)
            ->first();


        $htmlContent = $this->removeHeadTags(file_get_contents($contribution->html_url));

        return view('home.detail', [
            'contribution' => $contribution,
            'htmlContent' => $htmlContent,
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties
        ]);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->searchQuery;


        if (Auth::user()->role_id !=  UserRoleEnum::GUEST) {
            $contributions = Contribution::select(
                'contributions.*',
                'users.username AS student_name',
            )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchQuery) {
                    $query->where('contributions.title', 'like', "%$searchQuery%")
                        ->orWhere('users.username', 'like', "%$searchQuery%");
                })
                ->whereNotIn('contributions.status', [ContributionStatusEnum::PENDING, ContributionStatusEnum::PUBLISHED_FOR_GUEST])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $contributions = Contribution::select(
                'contributions.*',
                'users.username AS student_name',
            )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchQuery) {
                    $query->where('contributions.title', 'like', "%$searchQuery%")
                        ->orWhere('users.username', 'like', "%$searchQuery%");
                })
                ->where('users.faculty_id', '=', Auth::user()->faculty->id)
                ->where('contributions.status', '=', ContributionStatusEnum::PUBLISHED_FOR_GUEST)
                ->orWhere('status', '=', ContributionStatusEnum::PUBLISHED_ALL)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('home.search', [
            'contributions' => $contributions,
            'query' => $searchQuery,
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties
        ]);
    }

    public function filter(Request $request, $id)
    {
        if (Auth::user()->role_id !=  UserRoleEnum::GUEST) {
            $contributions = Contribution::select(
                'contributions.*',
                'users.username AS student_name',
            )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->where('users.faculty_id', '=', $id)
                ->whereNotIn('contributions.status', [ContributionStatusEnum::PENDING, ContributionStatusEnum::PUBLISHED_FOR_GUEST])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $contributions = Contribution::select(
                'contributions.*',
                'users.username AS student_name',
            )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->where('users.faculty_id', '=', Auth::user()->faculty->id)
                ->where('contributions.status', '=', ContributionStatusEnum::PUBLISHED_FOR_GUEST)
                ->orWhere('status', '=', ContributionStatusEnum::PUBLISHED_ALL)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $filterFaculty = Faculty::find($id);

        return view('home.filter', [
            'contributions' => $contributions,
            'filterFaculty' => $filterFaculty,
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties,
        ]);
    }

    private function removeHeadTags($html)
    {
        $headStart = '<head>';
        $headEnd = '</head>';

        // Find the position of <head> and </head> tags
        $startPos = strpos($html, $headStart);
        $endPos = strpos($html, $headEnd);

        // Remove <head> and </head> tags and the content between them
        if ($startPos !== false && $endPos !== false) {
            $html = substr_replace($html, '', $startPos, $endPos + strlen($headEnd) - $startPos);
        }

        return $html;
    }
}
