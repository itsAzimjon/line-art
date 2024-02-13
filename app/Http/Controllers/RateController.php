<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function like(Product $product)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login');
        }
    
        $existingRate = Rate::where('user_id', $user->id)->where('product_id', $product->id)->first();
    
        if ($existingRate) {
            $existingRate->delete();
        } else {
            Rate::create([
                'rate' => 5,
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
            ]);
        }
    
        return redirect()->back();
    }
}
