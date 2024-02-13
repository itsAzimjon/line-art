<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
 
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function forum()
    {
        $categories = Category::all();
        return view('forum', compact('categories'));
    }

    public function index()
    {
        $tags = Tag::all();
        $products = Product::latest()->get();
        $categories = Category::all();

        return view('welcome', compact(['tags','categories', 'products']));   
    }
}
