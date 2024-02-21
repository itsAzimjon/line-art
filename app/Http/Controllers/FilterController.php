<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $tags = Tag::all();
        $tagId = $request->input('tag_id');
        $roleModel = $request->input('role_model');
        $sortBy = $request->input('sort_by', 'popular');
        $query = $request->input('query');
        $role = $request->input('role_id');
        $p = $request->input('popular');

        $filteredProducts = Product::when($tagId, function ($query) use ($tagId) {
            $query->whereHas('tags', function ($tagQuery) use ($tagId) {
                $tagQuery->where('tags.id', $tagId);
            });
        })->when($roleModel, function ($query) use ($roleModel) {
            $query->where('role_model', $roleModel);
        });
    
        switch ($sortBy) {
            case 'popular':
                $filteredProducts->orderBy('view', 'desc');
            case 'highest_rated':
                $filteredProducts->withCount('raties')->orderByDesc('raties_count');
                break;
            case 'most_downloaded':
                $filteredProducts->withCount('downloads')->orderByDesc('downloads_count');
                break;
            case 'newest':
            default:
                $filteredProducts->orderBy('created_at', 'desc');
                break;
        }        

        if ($role) {
            $filteredProducts->where('title', 'like', "%{$query}%")->orWhere('description', 'like', "%{$query}%");
        }
        
    
        $filteredProducts = $filteredProducts->get();
    
        return view('product.filter', compact('filteredProducts', 'tags'));
    }

    
    
}
