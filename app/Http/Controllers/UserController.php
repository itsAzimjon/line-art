<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function admin()
    {
        $users = User::where('id', '>', 1)->get();
        return view('admin.user-list', compact('users'));
    }

    public function edit(User $user)
    {
        if (auth()->user()->role_id == 1) {
            
        }
        elseif (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        return view('auth.user-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'phone' => 'nullable|string',
            'region' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'age' => 'nullable|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $updateData = $validatedData;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('user');
            $updateData['photo'] = $photoPath;
        }
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        $user->update($updateData);

        return redirect()->back()->with('success', 'User data updated successfully');
    }

    public function userEditByAdmin(User $user)
    {
        return view('admin.user-edit', compact('user'));
    }

    public function userUpdateByAdmin(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'phone' => 'nullable|string',
            'region' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'credit' => 'nullable|numeric|min:0',
        ]);

    $updateData = $validatedData;

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($request->role_id != 0) {
            $updateData['role_id'] = $request->role_id;
        }
        $user->update($updateData);

        return redirect()->back()->with('success', 'User data updated successfully');
    }

    public function userDeleteByAdmin(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

}

