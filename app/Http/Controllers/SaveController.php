<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function save(Product $product)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login');
        }
    
        $existingRate = Save::where('user_id', $user->id)->where('product_id', $product->id)->first();
    
        if ($existingRate) {
            $existingRate->delete();
        } else {
            Save::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
            ]);
        }
    
        return redirect()->back();
    }
}
