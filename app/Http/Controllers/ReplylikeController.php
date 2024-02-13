<?php

namespace App\Http\Controllers;

use App\Models\Replylike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplylikeController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $existingRate = Replylike::where('user_id', $user->id)->where('reply_id', $request->reply_id)->first();

        if ($existingRate) {
            return redirect()->back();
        } else {
            Replylike::create([
                'user_id' => $user->id,
                'reply_id' => $request->reply_id,
            ]);    
        }

        return redirect()->back();
    }

    public function destroy($id) 
    {
        $replyLike = Replylike::findOrFail($id);

        if ($replyLike->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this reply like.');
        }
    
        $replyLike->delete();
    
        return redirect()->back()->with('success', 'Reply like deleted successfully.');
    }
}
