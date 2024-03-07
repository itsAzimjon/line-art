<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function create()
    {
        //
    }

    public function store(Request $request, Product $product)
    {
        Comment::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'product_id' => $request->product,
        ]);

        return redirect()->back();
    }

    public function edit(Comment $comment)
    {
        //
    }

 
    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        $productId = $comment->product->id;
        
        return redirect()->route('product.show', ['product' => $productId]);
    }
}
