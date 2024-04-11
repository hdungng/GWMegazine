<?php

namespace App\Http\Controllers;

use App\Enums\ContributionStatusEnum;
use App\Models\Contribution;
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
    public function index()
    {
        $contributions = Contribution::select('contributions.*', 'users.username AS student_name')
        ->join('users','contributions.user_id','=','users.id')
        ->where('status', '=', ContributionStatusEnum::PUBLISHED)
        ->orderBy('created_at','desc')
        ->get();
        
        return view('home.main-page', compact('contributions'));
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

        return view('home.detail', compact('contribution', 'htmlContent'));
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
