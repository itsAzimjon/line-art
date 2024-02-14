<?php

namespace App\Http\Controllers;

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
    
    public function create()
    {
        return view('product.create')->with([
            'categories' => Category::all(),
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
            'role_model' => $request->input('role_model'),
            'category_id' => $request->input('category_id'),
            'photo' => json_encode($mults),
            'file' => $file,
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'doc_number' => $request->input('doc_number'),
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
        $products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(3)->get();
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
        $categories = Category::all();
        $tags = Tag::all();
    
        return view('product.edit', compact('product', 'categories', 'tags'));
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
            'category_id' => $request->category_id,
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
