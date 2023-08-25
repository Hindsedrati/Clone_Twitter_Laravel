<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return $this->renderView('profile.edit', [ 'user' => $request->user() ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile picture.
     */
    public function updateProfilePicture(Request $request): RedirectResponse
    {
        
        $request->validate([
            'profile_picture' => ['required'],
        ],[
            'profile_picture.required' => 'Veuillez sélectionner une image'
        ]);

        $user = $request->user();

        $file = $request->input('profile_picture');
        $file_path = Storage::move('tmp/'.$file, 'public/profiles/'.$file);

        $user->picture_path = $file;

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'picture-updated');
    }

    /**
     * Update the user's profile banner.
     */
    public function updateProfileBanner(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_banner' => ['required'],
        ],[
            'profile_banner.required' => 'Veuillez sélectionner une image'
        ]);

        $user = $request->user();

        $file = $request->input('profile_banner');
        $file_path = Storage::move('tmp/'.$file, 'public/profiles/'.$file);

        $user->banner_path = $file;

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'banner-updated');
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
