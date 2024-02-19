<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Product;
use App\Models\Save;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function buy(Product $product)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userCredit = $user->credit - $product->price;
        $exist = Download::where('user_id', $user->id)->where('product_id', $product->id)->first();
        $filePath = storage_path('app/public/' . $product->file);

        if ($exist) {
            return response()->download($filePath, $product->file_name);            

        } elseif ($userCredit >= 0) {
            Download::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);

            User::where('id', $user->id)->update([
                'credit' => $userCredit
            ]);

            return response()->download($filePath, $product->file_name);            
        } else {
            return back()->with('error', 'Credits are not enough');
        }
    }
    public function price()
    {
        return view('product.price');
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $downloads = Download::where('user_id', auth()->user()->id)->get();
        $saves = Save::where('user_id', auth()->user()->id)->get();
        return view('downloads', compact(['downloads', 'saves']));
    }
}
