<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        return view('profiles.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profiles.edit', ['profile' => $user->profile]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $data = $request->validate([
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
        ]);
        $profile->update([
            'bio' => $data['bio'] ?? $profile->bio,
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('post_images', 'public');
            $profile->avatar()->create([
                'path' => $path,
            ]);
        }

        return redirect()->route('profiles.show', $user->id)
            ->with('success', 'Profile updated successfully!');
    }
}
