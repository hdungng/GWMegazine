<?php

namespace App\Http\Controllers;

use App\Enums\ContributionStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Contribution;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Mail;
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

    public function edit($id)
    {
        $contribution = Contribution::select(
            'contributions.*',
            'users.username AS student_name',
            'users.email AS email',
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

        if (!$contribution) {
            toastr()->error('Contribution is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        return view('admin.contributions.edit', compact('contribution'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:500|min:20',
            'wordDocument' => 'mimes:doc,docx',
            'contributionImage' => 'image|mimes:png,jpg,jpeg',
        ], [
            'document.mimes:doc,docx' => ':attribute must be a Word file (doc/docx).',
            'required' => ":attribute is required",
            'min' => ":attribute must be at least :min characters long",
            'max' => ":attribute must be at most :max characters long",
            'image' => ":attribute must be an image file in jpeg, png, bmp, or gif format",
            'square' => ":attribute must be a square image",
        ], [
            'title' => 'Contribution Title',
            'description' => 'Description',
            'wordDocument' => 'Word Document',
            'contributionImage' => 'Contribution Image',
        ]);

        $contribution = Contribution::find($id);

        if (!$contribution) {
            // contribution not found, handle the case accordingly
            toastr()->error('Contribution is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $contribution->title = $request->title;
        $contribution->description = $request->description;


        if ($request->hasFile('contributionImage')) {
            $contributionImage_file = $request->file('contributionImage');
            $contributionImage_file_name = $contributionImage_file->getClientOriginalName();

            $contributionImage_file->move('public/uploads/images/contribution-images', $contributionImage_file_name);

            $contributionImage = "public/uploads/images/contribution-images/" . $contributionImage_file_name;

            // DELETE OLD (IMAGE) FILE 
            if (File::exists($contribution->image_url)) {
                File::delete($contribution->image_url);
            }

            $contribution->image_url = $contributionImage;
        }

        if ($request->hasFile('wordDocument')) {
            $word_file = $request->file('wordDocument');
            $word_file_name = $word_file->getClientOriginalName();
            // GET FILES NAME
            $word_file_name_no_extension = pathinfo($word_file_name, PATHINFO_FILENAME);

            // =================================================
            //    UPLOAD WORD -> HTML
            // =================================================
            $phpWord = IOFactory::createReader('Word2007')->load($word_file->path());
            $objWriter = IOFactory::createWriter($phpWord, 'HTML');
            $html_url = $_SERVER['DOCUMENT_ROOT'] . '/gw-megazine/public/uploads/contribution_html/' .  $word_file_name_no_extension . '.html';

            $html_url_model = 'public/uploads/contribution_html/' . $word_file_name_no_extension . '.html';
            $objWriter->save($html_url);

            // UPLOAD FILES
            $word_file->move('public/uploads/words', $word_file_name);

            $contributionWord = "public/uploads/words/" . $word_file_name;

            // DELETE OLD (WORD, HTML) FILE 
            if (
                File::exists($contribution->word_url)
                && File::exists($contribution->html_url)
            ) {
                File::delete($contribution->word_url);
                File::delete($contribution->html_url);
            }

            $contribution->html_url = $html_url_model;
            $contribution->word_url = $contributionWord;
        }

        $contribution->save();


        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Coordinator ' . Auth::user()->username . ' has updated a new contribution successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Contribution updated successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('admin.contributions.detail', $contribution->id);
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

        $disabledComment = now() >= $contribution->created_at->addDays(14);


        $htmlContent = $this->removeHeadTags(file_get_contents($contribution->html_url));

        return view('admin.contributions.preview', compact('contribution', 'htmlContent', 'comments', 'disabledComment'));
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
