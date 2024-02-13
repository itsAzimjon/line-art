<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $tags = Tag::all();
        $tagId = $request->input('tag_id');
        $roleModel = $request->input('role_model');

        $filteredProducts = Product::when($tagId, function ($query) use ($tagId) {
            $query->whereHas('tags', function ($tagQuery) use ($tagId) {
                $tagQuery->where('tags.id', $tagId);
            });
        })->when($roleModel, function ($query) use ($roleModel) {
            $query->where('role_model', $roleModel);
        })->get();
        
        return view('product.filter', compact(['filteredProducts', 'tags']));
    }
}
