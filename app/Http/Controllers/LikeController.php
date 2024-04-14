<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LikeController extends Controller
{
    //
    public function like(Request $request)
    {
        $like = Like::where('contribution_id', $request->id)
            ->where('user_id', Auth::user()->id) // Assuming user authentication
            ->first();

        $notLiked = null;

        if ($like) {
            $like->delete();
            $likeCount = Like::where('contribution_id', $request->id)
                ->count();


            $notLiked = true;
        } else {
            $like = Like::create([
                'id' => Str::uuid(),
                'contribution_id' => $request->id,
                'user_id' => auth()->id(),
            ]);

            $likeCount = Like::where('contribution_id', $request->id)
                ->count();

            $notLiked = false;
        }

        return response()->json([
            'success' => true,
            'likeCount' => $likeCount,
            'notLiked' => $notLiked, // Indicate like state (true - not liked, false - liked)
        ]);
    }

    public function getTotalLike($id)
    {
        $likeCount = Like::where('contribution_id', $id)
            ->count();

        $result = [
            'success' => true,
            'likeCount' => $likeCount,
        ];

        if (Auth::check()) {
            $like = Like::where('contribution_id', $id)
                ->where('user_id', Auth::user()->id) // Assuming user authentication
                ->first();

            $result['notLiked'] = !$like;
        }

        return response()->json($result);
    }
}
