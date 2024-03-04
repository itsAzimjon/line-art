<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function forumcomp()
    {
        $products = Product::all();
        return view('components.left-side', compact('products'));
    }
    
    public function showpunkt($branch, Tag $tag)
    {
        $products = $tag->products()->where('branch_id', $branch)->get();
        return view('product.showpunkt', compact('products', 'branch'));
    }

    public function create()
    {
        return view('product.create')->with([
            'branches' => Branch::where('id', '<', '2')->get(),
            'tags' => Tag::all(),
        ]);
    }

    public function store(Request $request)
    {        
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
            'file' => $file,
            'title' => $request->title,
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
        $views = $product->views;
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
        $branches = Branch::where('id', '<', '2')->get();
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
