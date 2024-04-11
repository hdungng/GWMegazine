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
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Str;

class HomeContributionController extends Controller
{
    //
    public $dayLeft;
    public $hoursLeft;

    public $closedContribution;

    public $closedContributionAdd;


    public function __construct()
    {
        $currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();
        $currentDateTime = Carbon::now();

        $this->closedContribution = null;
        $this->closedContributionAdd = false;

        if ($currentDateTime->gt($currentAcademicYear->closure_date)) {
            // The current time has passed the deadline
            $this->closedContributionAdd = true;
        }

        if ($currentDateTime->gt($currentAcademicYear->final_closure_date)) {
            // The current time has passed the deadline
            $this->closedContribution = true;
        } else {
            // The current time is before the deadline
            $this->closedContribution = false;

            // Calculate the difference between the current time and the deadline
            $this->dayLeft = $currentDateTime->diff($currentAcademicYear->final_closure_date)->days;
            $this->hoursLeft = $currentDateTime->diff($currentAcademicYear->final_closure_date)->h;
        }
    }

    public function index()
    {
        $contributions = Contribution::where("user_id", Auth::user()->id)
            ->orderBy("created_at", "desc")->get();

        return view(
            "home.contributions.list",
            [
                'dayLeft' => $this->dayLeft,
                'hoursLeft' => $this->hoursLeft,
                'closedContributionAdd' => $this->closedContributionAdd,
                'contributions' => $contributions
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
        ->join('users','comments.user_id','=','users.id')
        ->where('contribution_id', $id)
        ->get();
        

        return view("home.contributions.detail", [
            'dayLeft' => $this->dayLeft,
            'hoursLeft' => $this->hoursLeft,
            'closedContribution' => $this->closedContribution,
            'contribution' => $contribution,
            'comments' => $comments
        ]);
    }

    public function create()
    {
        $currentAcademicYear = AcademicYear::where("status", '=', AcademicYearStatusEnum::SELECTED)->first();

        if ($this->closedContributionAdd) {
            toastr()->error('Sorry, currently the closure date is over!', 'Error', ['timeOut' => 5000]);
            return redirect()->back();
        }
        return view("home.contributions.create", [
            'dayLeft' => $this->dayLeft,
            'hoursLeft' => $this->hoursLeft,
            'currentAcademicYear' => $currentAcademicYear->name
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

        //GET CURRENT ACADEMIC YEAR ACTIVE
        $currentAcademicYear = AcademicYear::where('status', 1)->first();

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
        $contribution->academic_year_id = $currentAcademicYear->id;


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
