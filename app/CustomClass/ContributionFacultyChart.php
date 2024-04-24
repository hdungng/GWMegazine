<?php

namespace App\CustomClass;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\DB;

class ContributionFacultyChart
{
    public $facultyNames;

    public $datasets;

    public $colors;


    public function __construct()
    {

        $this->facultyNames = DB::table('users')
            ->select(DB::raw('distinct(short_name)'))
            ->join('contributions', 'users.id', '=', 'contributions.user_id')
            ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->where('users.role_id', UserRoleEnum::STUDENT)
            ->pluck('short_name')
            ->toArray();
        $this->colors = DB::table('users')
            ->select(DB::raw('distinct(chart_color)'))
            ->join('contributions', 'users.id', '=', 'contributions.user_id')
            ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->where('users.role_id', UserRoleEnum::STUDENT)
            ->pluck('chart_color')
            ->toArray();
    }
}
