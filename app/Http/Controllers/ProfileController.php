<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // show user profile
    public function showProfile(User $username)
    {
        $user = auth()->user();

        return view('profile.profile', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate(
            [
                'username' => ['required', 'string', 'max:255', 'lowercase', 'regex:/^[a-z0-9_]+$/', 'unique:' . User::class . ',username,' . $user->id],
                'display_name' => ['string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email,' . $user->id],
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'username.regex' => 'The username may only contain letters, numbers, and underscores.',
            ],
        );

        // Handle file upload
        $currentAvatar = $user->avatar;
        $filename = $this->handleAvatarUpload($request, $currentAvatar);

        $userData = [
            'username' => $request->username,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'avatar' => $filename,
            'updated_at' => now(),
        ];

        User::where('id', $user->id)->update($userData);

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    private function handleAvatarUpload(Request $request, $currentAvatar)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Save the new file in the 'public/avatars' directory
            $avatar->storeAs('public/avatars', $filename);

            // Delete the old avatar if it exists and is not the default avatar
            if ($currentAvatar && $currentAvatar !== 'default.jpg') {
                $oldAvatarPath = storage_path('app/public/avatars/' . $currentAvatar);

                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            return $filename; // Return the generated filename for the new avatar
        }

        // If no new avatar file is provided, return the current avatar filename
        return $currentAvatar;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
