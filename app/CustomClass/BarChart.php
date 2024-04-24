<?php

namespace App\CustomClass;

use Illuminate\Support\Facades\DB;

class BarChart
{
    public $academicYearNames;

    public $datasets;

    public function __construct($datasets)
    {
        $this->academicYearNames = DB::table('academic_years')
        ->select(DB::raw('distinct(name)'))
        ->join('contributions', 'academic_years.id', '=', 'contributions.academic_year_id')
        ->pluck('name')
        ->toArray();

        $this->datasets = $datasets;
    }
}
