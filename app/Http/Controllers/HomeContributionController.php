<?php

namespace App\Http\Controllers;

use App\Enums\AcademicYearStatusEnum;
use App\Enums\ContributionStatusEnum;
use App\Enums\UserRoleEnum;
use App\Mail\ContributionMail;
use App\Models\AcademicYear;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Contribution;
use App\Models\Faculty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Str;

class HomeContributionController extends Controller
{
    //
    public $currentAcademicYear;
    public $dayLeft;
    public $hoursLeft;

    public $startingDateOpen;

    public $closedContribution;

    public $closedContributionAdd;

    public $faculties;

    public function __construct()
    {
        $this->currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();
        $currentDateTime = Carbon::now();

        $this->closedContribution = null;
        $this->closedContributionAdd = false;

        if ($currentDateTime->gt($this->currentAcademicYear->closure_date)) {
            $this->closedContributionAdd = true;
        }

        if ($currentDateTime->gt($this->currentAcademicYear->final_closure_date)) {
            $this->closedContribution = true;
        } else {
            // The current time is before the deadline
            $this->closedContribution = false;

            $this->dayLeft = $currentDateTime->diff($this->currentAcademicYear->final_closure_date)->days;
            $this->hoursLeft = $currentDateTime->diff($this->currentAcademicYear->final_closure_date)->h;
        }

        if ($currentDateTime->gt($this->currentAcademicYear->starting_date)) {
            $this->startingDateOpen = true;
        } else {
            $this->startingDateOpen = false;
        }

        $this->faculties = Faculty::orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        $contributions = Contribution::where("user_id", Auth::user()->id)
            ->where('academic_year_id', '=', $this->currentAcademicYear->id)
            ->get();

        return view(
            "home.contributions.list",
            [
                'startingDateOpen' => $this->startingDateOpen,
                'dayLeft' => $this->dayLeft,
                'hoursLeft' => $this->hoursLeft,
                'closedContributionAdd' => $this->closedContributionAdd,
                'contributions' => $contributions,
                'faculties' => $this->faculties
            ]
        );
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


        $comments = Comment::select('comments.*', 'users.fullname AS username', 'users.avatar AS avatar')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('contribution_id', $id)
            ->get();

        $disabledComment = now() >= $contribution->created_at->addDays(14);

        return view("home.contributions.detail", [
            'startingDateOpen' => $this->startingDateOpen,
            'dayLeft' => $this->dayLeft,
            'hoursLeft' => $this->hoursLeft,
            'closedContribution' => $this->closedContribution,
            'contribution' => $contribution,
            'comments' => $comments,
            'disabledComment' => $disabledComment,
            'faculties' => $this->faculties
        ]);
    }

    public function create()
    {
        $this->currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();

        if (!$this->startingDateOpen) {
            toastr()->error('Sorry, currently the starting date has not come yet!', 'Error', ['timeOut' => 5000]);
            return redirect()->back();
        }

        if ($this->closedContributionAdd) {
            toastr()->error('Sorry, currently the closure date is over!', 'Error', ['timeOut' => 5000]);
            return redirect()->back();
        }
        return view("home.contributions.create", [
            'startingDateOpen' => $this->startingDateOpen,
            'dayLeft' => $this->dayLeft,
            'hoursLeft' => $this->hoursLeft,
            'currentAcademicYear' => $this->currentAcademicYear->name,
            'faculties' => $this->faculties
        ]);
    }

    public function store(Request $request)
    {
        if ($this->closedContributionAdd) {
            toastr()->error('Sorry, currently the closure date is over!', 'Error', ['timeOut' => 5000]);
            return redirect()->back();
        }

        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:500|min:20',
            'wordDocument' => 'required|mimes:doc,docx',
            'contributionImage' => 'required|image|mimes:png,jpg,jpeg',
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

        // GET STUDENT'S COORDINATOR EMAIL
        $coordinator = User::select('users.*')
            ->join('faculties', 'users.id', '=', 'faculties.coordinator_id')
            ->where('users.role_id', '=', UserRoleEnum::COORDINATOR)
            ->where('faculties.id', '=', Auth::user()->faculty->id)
            ->first();

        if (!$coordinator) {
            toastr()->error('Sorry, currently there is no coordinator in your faculty so you cannot submit your contribution!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $contributionImage_file = $request->file('contributionImage');
        $word_file = $request->file('wordDocument');


        // GET FILES NAME
        $contributionImage_file_name = $contributionImage_file->getClientOriginalName();
        $word_file_name = $word_file->getClientOriginalName();

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
        $contributionImage_file->move('public/uploads/images/contribution-images', $contributionImage_file_name);
        $word_file->move('public/uploads/words', $word_file_name);


        $contributionImage = "public/uploads/images/contribution-images/" . $contributionImage_file_name;
        $contributionWord = "public/uploads/words/" . $word_file_name;


        $contribution = new Contribution();
        $contribution->id = Str::uuid();
        $contribution->user_id = Auth::user()->id;
        $contribution->title = $request->title;
        $contribution->status = ContributionStatusEnum::PENDING;
        $contribution->description = $request->description;
        $contribution->image_url = $contributionImage;
        $contribution->html_url = $html_url_model;
        $contribution->word_url = $contributionWord;
        $contribution->academic_year_id = $this->currentAcademicYear->id;


        $contributionSavedId = $contribution->id;


        $contribution->save();

        // SEND EMAIL FOR COORDINATOR

        $mailData = [
            'contributionTitle' => $request->title,
        ];
        Mail::to($coordinator->email)->send(new ContributionMail($mailData));

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Student ' . Auth::user()->username . ' ('  .  Auth::user()->faculty->name  . ' )' .  ' has submitted a new contribution successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Contribution submitted successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('home.contributions.detail', $contributionSavedId);
    }

    public function edit(Request $request, $id)
    {
        $this->currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();

        $contribution = Contribution::find($id);

        if (!$contribution) {
            toastr()->error('Contribution is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        if ($contribution->status != 0) {
            toastr()->error('Contribution is published which cannot edit!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        if ($this->closedContribution) {
            toastr()->error('Sorry, currently the final closure date is over!', 'Error', ['timeOut' => 5000]);
            return redirect()->back();
        }


        return view("home.contributions.edit", [
            'startingDateOpen' => $this->startingDateOpen,
            'dayLeft' => $this->dayLeft,
            'hoursLeft' => $this->hoursLeft,
            'currentAcademicYear' => $this->currentAcademicYear->name,
            'contribution' => $contribution,
            'faculties' => $this->faculties
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($this->closedContribution) {
            toastr()->error('Sorry, currently the closure date is over!', 'Error', ['timeOut' => 5000]);
            return redirect()->back();
        }

        $request->validate([
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


        // GET STUDENT'S COORDINATOR EMAIL
        $coordinator = User::select('users.*')
            ->join('faculties', 'users.id', '=', 'faculties.coordinator_id')
            ->where('users.role_id', '=', UserRoleEnum::COORDINATOR)
            ->where('faculties.id', '=', Auth::user()->faculty->id)
            ->first();

        if (!$coordinator) {
            toastr()->error('Sorry, currently there is no coordinator in your faculty so you cannot submit your contribution!', 'Error', ['timeOut' => 5000]);
            return back();
        }

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

        // SEND EMAIL FOR COORDINATOR

        $mailData = [
            'contributionTitle' => $request->title,
        ];
        Mail::to($coordinator->email)->send(new ContributionMail($mailData));

        ActivityLog::create([
            'id' => Str::uuid(),
            'content' => 'Student ' . Auth::user()->username . ' ('  .  Auth::user()->faculty->name  . ' )' .  ' has updated a new contribution successfully!',
            'user_id' => Auth::user()->id,
        ]);

        toastr()->success('Contribution updated successfully!', 'Success', ['timeOut' => 5000]);
        return redirect()->route('home.contributions.detail', $contribution->id);
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
        return redirect()->route('home.contributions.detail', $id);
    }
}
