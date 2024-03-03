<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function show(Branch $branch){
        return view('branch.show', compact('branch'));
    }

    public function store(Request $request)
    {
        $branch = Branch::create([
            'name' => $request['name'],
        ]);

        if ($request->has('category_id')) {
            $branch->categories()->attach($request['category_id']);
        }

        return redirect()->back()->with('success', 'Branch created successfully');
    }

    public function update(Request $request, Branch $branch)
    {
        $branch->update([
            'name' => $request->name
        ]);
    
        if ($request->has('category_id')) {
            $branch->categories()->sync($request->input('category_id'));
        } else {
            $branch->categories()->detach();
        }

        return redirect()->back()->with('success', 'Branch updated successfully');
    }


    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('home');
    }

}
