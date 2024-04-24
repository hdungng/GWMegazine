<?php

namespace App\Http\Controllers;

use App\Enums\AcademicYearStatusEnum;
use App\Models\AcademicYear;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeOtherPagesController extends Controller
{
    //

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

    function content_policy()
    {
        return view("home/others/content-policy", [
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties
        ]);
    }

    function user_agreement()
    {
        return view("home/others/user-agreement", [
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties
        ]);
    }

    function help()
    {
        return view("home/others/help", [
            'startingDateOpen' => $this->startingDateOpen,
            'faculties' => $this->faculties
        ]);
    }
}
