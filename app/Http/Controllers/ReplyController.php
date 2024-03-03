<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function check(Reply $reply)
    {
        if($reply->true_answer != 1){
            $reply->update([
                'true_answer' => 1
            ]);
        }else{
            $reply->update([
                'true_answer' => null
            ]);  
        }

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Reply::create([
            'user_id' => auth()->user()->id,
            'forum_id' => $request->forum_id,
            'comment' => $request->comment,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
        $forumId = $reply->forum->id;
        
        return redirect()->route('forum.show', ['forum' => $forumId]);
    }
}
