<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{ 
    public function create()
    {
        $tags = Tag::all();
        return view('forum.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $validatedData = $request->validate([
            'tag_id' => 'required|exists:tags,id', 
            'title' => 'required|string', 
            'description' => 'required|string', 
        ]);

        $forum = Forum::create([
            'user_id' => $user->id,
            'tag_id' => $validatedData['tag_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => '0',
            'views' => 0,
        ]);
    
        return redirect()->route('forum.show', ['forum' => $forum->id]);
    }

    public function show(Forum $forum)
    {
        $views = $forum->views;
        $views++;
        $forum->update([
            'views' => $views
        ]);
        return view('forum.show', compact('forum'));
    }

    public function edit(Forum $forum)
    {
        if (auth()->user()->role_id == 1) {
            
        }
        elseif (Auth::id() !== $forum->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $tags = Tag::all();
        return view('forum.edit', compact(['forum', 'tags']));
    }

    public function update(Request $request, Forum $forum)
    {
        $validatedData = $request->validate([
            'tag_id' => 'required|exists:tags,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
    
        $forum->update([
            'tag_id' => $validatedData['tag_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        return redirect()->route('forum.show', $forum)->with('success', 'Forum updated successfully');
    }

    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->route('forum');
    }
}
