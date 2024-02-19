<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('welcome', compact('tags'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Tag::create([
            'category_id' => $request['category_id'],
            'name' => $request['name'],
        ]);
        
        return redirect()->back()->with('success', 'Tag created successfully.');
    }

    public function show(Tag $tag)
    {
        return view('tag.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(Request $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('home');
    }
}
