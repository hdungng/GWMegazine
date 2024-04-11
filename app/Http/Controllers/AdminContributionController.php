<?php

namespace App\Http\Controllers;

use App\Enums\ContributionStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Contribution;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminContributionController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->id == UserRoleEnum::COORDINATOR) {

            $currentFaculty = Faculty::select(
                'faculties.*',
                'users.id AS faculty_id'
            )->join('users', 'users.id', '=', 'faculties.coordinator_id')
                ->where('faculties.coordinator_id', Auth::user()->id)->first();


            $contributions = Contribution::select(
                'contributions.*',
                'users.username AS student_name',
                'faculties.name AS faculty_name',
                'academic_years.name AS academic_year_name'
            )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('academic_years', 'contributions.academic_year_id', '=', 'academic_years.id')
                ->orderBy('created_at', 'desc')
                ->where('faculty_id', '=', $currentFaculty->id)
                ->get();
        } else {
            $contributions = Contribution::select(
                'contributions.*',
                'users.username AS student_name',
                'faculties.name AS faculty_name',
                'academic_years.name AS academic_year_name'
            )
                ->join('users', 'contributions.user_id', '=', 'users.id')
                ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
                ->join('academic_years', 'contributions.academic_year_id', '=', 'academic_years.id')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('admin.contributions.list', compact('contributions'));
    }

    public function detail($id)
    {
        $contribution = Contribution::select(
            'contributions.*',
            'users.username AS student_name',
            'users.avatar AS student_avatar',
            'faculties.name AS faculty_name',
            'academic_years.name AS academic_year_name',
            'academic_years.closure_date',
            'academic_years.final_closure_date',
        )
            ->join('users', 'contributions.user_id', '=', 'users.id')
            ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->join('academic_years', 'contributions.academic_year_id', '=', 'academic_years.id')
            ->where('contributions.id', '=', $id)
            ->first();

        return view('admin.contributions.detail', compact('contribution'));
    }

    public function edit()
    {
        return view('admin.contributions.edit');
    }

    public function preview($id)
    {
        $contribution = Contribution::select(
            'contributions.*',
            'users.username AS student_name',
        )
            ->join('users', 'contributions.user_id', '=', 'users.id')
            ->where('contributions.id', '=', $id)
            ->first();

        $comments = Comment::select('comments.*', 'users.fullname AS username', 'users.avatar AS avatar')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('contribution_id', $id)
            ->get();

        $htmlContent = $this->removeHeadTags(file_get_contents($contribution->html_url));

        return view('admin.contributions.preview', compact('contribution', 'htmlContent', 'comments'));
    }

    public function publish(Request $request)
    {
        $contribution = Contribution::find($request->contributionIdPublish);

        if (!$contribution) {
            toastr()->error('Contribution is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $contribution->status = ContributionStatusEnum::PUBLISHED;
        $contribution->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Contribution ' .  $contribution->title  . ' published successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Contribution published successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.contributions.index');
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500|min:10',
        ], [
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
        ], [
            'content' => "Comment content",
        ]);

        $comment = new Comment();

        $comment->id = Str::uuid();
        $comment->content = $request->content;
        $comment->user_id = Auth::user()->id;
        $comment->contribution_id = $id;
        $comment->save();

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Comment is added successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Comment is added successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.contributions.detail', $id);
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
