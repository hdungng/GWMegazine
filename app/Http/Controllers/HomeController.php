<?php

namespace App\Http\Controllers;

use App\Enums\ContributionStatusEnum;
use App\Models\Contribution;
use App\Models\Faculty;
use Illuminate\Http\Request;

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
    public $faculties;


    public function __construct()
    {
        $this->faculties = Faculty::orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        $contributions = Contribution::with('likes')->select('contributions.*', 'users.username AS student_name')
            ->join('users', 'contributions.user_id', '=', 'users.id')
            ->where('status', '=', ContributionStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(15);

        return view('home.main-page', [
            'contributions' => $contributions,
            'faculties' => $this->faculties,
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
            'faculties' => $this->faculties,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->searchQuery;
        $contributions = Contribution::select(
            'contributions.*',
            'users.username AS student_name',
        )
            ->join('users', 'contributions.user_id', '=', 'users.id')
            ->where('contributions.title', 'like', "%$query%")
            ->orWhere('users.username', 'like', "%$query%")
            ->orderBy('created_at', 'desc')
            ->get();

        $faculties = Faculty::orderBy('created_at', 'desc')->get();


        return view('home.search', [
            'contributions' => $contributions,
            'query' => $query,
            'faculties' => $this->faculties,
        ]);
    }


    public function filter(Request $request, $id)
    {
        $contributions = Contribution::select(
            'contributions.*',
            'users.username AS student_name',
        )
            ->join('users', 'contributions.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $faculties = Faculty::orderBy('created_at', 'desc')->get();

        $filterFaculty = Faculty::find($id);

        return view('home.filter', [
            'contributions' => $contributions,
            'filterFaculty' => $filterFaculty,
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
