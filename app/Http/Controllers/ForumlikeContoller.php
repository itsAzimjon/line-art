<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Forumlike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumlikeContoller extends Controller
{

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $existingRate = Forumlike::where('user_id', $user->id)->where('forum_id', $request->forum_id)->first();

        if ($existingRate) {
            $existingRate->delete();
        } else {
            Forumlike::create([
                'user_id' => $user->id,
                'forum_id' => $request->forum_id,
            ]);    
        }

        return redirect()->back();
    }
}
