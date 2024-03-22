<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('content-editor')) {
                return $next($request);
            }
            abort(403, 'Unauthorized action.');
        })->only(['edit', 'store', 'update', 'create', 'productCreateIn', 'destroy']);
    }
    
    public function forumcomp()
    {
        $products = Product::all();
        return view('components.left-side', compact('products'));
    }
    
    public function showpunkt(Branch $branch, Tag $tag)
    {
        $products = $tag->products()->where('branch_id', $branch)->get();
        return view('product.showpunkt', compact('products', 'branch', 'tag'));
    }

    public function create()
    {
        $branches = Branch::where('id', '>', '2')->get();      
        $tags = $branches->flatMap->categories->flatMap->tags->unique('id');  
        return view('product.create', compact(['tags', 'branches']));
    }

    public function productCreateIn($branch, $tag)
    {
        $branches = Branch::where('id', '>', '2')->get();      
        $tags = $branches->flatMap->categories->flatMap->tags->unique('id');  
        return view('product.create-in', compact(['tags', 'branch', 'tag']));
    }

    public function store(Request $request)
    {        
        $request->validate([
            'mult_image' => 'required|array|min:1',
        ]);

        $mults = [];

        if ($request->hasFile('mult_image')) {
            foreach ($request->file('mult_image') as $image) {
                $mult = $image->store('post-mult-image');
                $mults[] = $mult;
            }
        }

        $file = $request->hasFile('file') ? $request->file('file')->store('model') : null;

        $product = Product::create([
            'branch_id' => $request->branch_id,
            'photo' => json_encode($mults),
            'file' => $file ?? null,
            'title' => $request->title,
            'author' => $request->author ?? null,
            'price' => $request->price,
            'description' => $request->description,
            'doc_number' => $request->doc_number,
        ]);

        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                $product->tags()->attach($tag);
            }
        }

        return redirect()->route('product.show', ['product' => $product->id])->with('success', 'Product created successfully.');
    }
    
    public function show(Product $product)
    {
        $views = $product->view;
        $views++;
        $product->update([
            'view' => $views
        ]);

        $products = Product::where('branch_id', '>', '2')->where('id', '!=', $product->id)->take(3)->get();
        return view('product.show', compact(['product', 'products']));
    }

    public function credit(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $amount = auth()->user()->credit + $request->credit;

        $user->update([
            'credit' => $amount
        ]);

        return redirect()->back();
    }

    public function edit(Product $product)
    {
        $branches = Branch::where('id', '>', '2')->get();
        $tags = Tag::all();
    
        return view('product.edit', compact('product', 'branches', 'tags'));
    }

    public function update(Request $request, Product $product)
    {
        $mults = [];

        if ($request->hasFile('mult_image')) {
            foreach ($request->file('mult_image') as $image) {
                $mult = $image->store('post-mult-image');
                $mults[] = $mult;
            }
        }

        $file = $request->hasFile('file') ? $request->file('file')->store('model') : null;

        $product->update([
            'role_model' => $request->role_model,
            'branch_id' => $request->branch_id,
            'photo' => !empty($mults) ? json_encode($mults) : $product->photo,
            'file' => $file ?? $product->file,
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
            'doc_number' => $request->doc_number,
        ]);

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        } else {
            $product->tags()->detach();
        }

        return redirect()->route('product.show', ['product' => $product->id])->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('home');
    }
}
