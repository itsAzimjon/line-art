<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showpro($branch, Category $category)
    {
        $views = $category->views;
        $views++;
        $category->update([
            'views' => $views
        ]);
        return view('category.showpro', compact('branch', 'category'));
    }

    public function index()
    {
        $categories = Category::all();
        return view('components.tag-create', compact('categories'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        $views = $category->views;
        $views++;
        $category->update([
            'views' => $views
        ]);
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('home');
    }
}
