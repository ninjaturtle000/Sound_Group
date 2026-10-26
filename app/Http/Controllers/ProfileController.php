<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $reviews = Review::with(['user'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('pages.profile', compact('user', 'reviews'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'min:7', 'max:25', 'regex:/^[0-9\+\-\s\(\)]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:500'],
            'avatar' => ['nullable', 'url', 'max:500'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile information updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Your password has been changed successfully.');
    }
}
