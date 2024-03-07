<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('branch_id', 'like', '1')->orderByDesc('created_at')->get();

        return view('articles.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTwo($role)
    {
        $tags = Tag::all();
        return view('articles.create', compact(['tags', 'role']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $product = Product::create([
            'branch_id' => $request->branch_id,
//            'owner' => auth()->name,
            'photo' => json_encode($mults),
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author ?? null,
        ]);

        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                $product->tags()->attach($tag);
            }
        }

        return redirect()->route('article.show', ['article' => $product->id])->with('success', 'Product created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  Product $article
     * @return \Illuminate\Http\Response
     */
    public function show(Product $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Product $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $article)
    {
        $tags = Tag::all();
    
        return view('articles.edit', compact('article', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Product $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $article)
    {
        $mults = [];

        if ($request->hasFile('mult_image')) {
            foreach ($request->file('mult_image') as $image) {
                $mult = $image->store('post-mult-image');
                $mults[] = $mult;
            }
        }

        $article->update([
            'photo' => !empty($mults) ? json_encode($mults) : $article->photo,
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
        ]);

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        } else {
            $article->tags()->detach();
        }

        return redirect()->route('article.show', ['article' => $article->id])->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Product $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $article)
    {
        //
    }
}
