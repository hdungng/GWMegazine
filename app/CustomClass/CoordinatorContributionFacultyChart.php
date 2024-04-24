<?php

namespace App\CustomClass;

use App\Enums\UserRoleEnum;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoordinatorContributionFacultyChart
{
    public $labels;

    public $datasets;

    public $colors;


    public function __construct()
    {
        $currentFaculty = Faculty::select(
            'faculties.*',
            'users.id AS faculty_id'
        )->join('users', 'users.id', '=', 'faculties.coordinator_id')
            ->where('faculties.coordinator_id', Auth::user()->id)->first();

        $blendColor = '#' . dechex(hexdec($currentFaculty->chart_color) / 155);

        $this->colors = [$currentFaculty->chart_color, $blendColor];
    }
}
