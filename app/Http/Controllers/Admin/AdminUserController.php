<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;

use App\Models\Report;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function userEdit(User $user)
    {
        return $this->renderAdminView('admin.editUser', [ 'user' => $user ]);
    }

    /**
     * Password reset link request.
     * 
     * @return \Illuminate\View\View
     */
    public function resetPassword(User $user)
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $user->only('email')
        );

        return back()->with('status', __($status));
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'username' => ['required', 'string', 'min:3', 'max:35', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255'],
        ],[
            'name.required' => 'Veuillez entrer votre nom',
            'name.string' => 'Veuillez entrer un nom valide',
            'name.min' => 'Votre nom doit contenir au moins 3 caractères',
            'name.max' => 'Votre nom doit contenir au maximum 20 caractères',
            'name.unique' => 'Ce nom est déjà utilisé',
            'username.required' => 'Veuillez entrer votre nom d\'utilisateur',
            'username.string' => 'Veuillez entrer un nom d\'utilisateur valide',
            'username.min' => 'Votre nom d\'utilisateur doit contenir au moins 3 caractères',
            'username.max' => 'Votre nom d\'utilisateur doit contenir au maximum 35 caractères',
            'email.required' => 'Veuillez entrer votre adresse email',
            'email.string' => 'Veuillez entrer une adresse email valide',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'email.max' => 'Votre adresse email doit contenir au maximum 255 caractères',
            'email.unique' => 'Cette adresse email est déjà utilisée',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return back()->with('status', 'profile-updated');
    }

    public function updateProfilePicture(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'profile_picture' => ['required'],
        ],[
            'profile_picture.required' => 'Veuillez sélectionner une image'
        ]);

        $file = $request->input('profile_picture');
        $file_path = Storage::move('tmp/'.$file, 'public/profiles/'.$file);

        $user->picture_path = $file;

        $user->save();

        return back()->with('status', 'picture-updated');
    }

    public function updateProfileBanner(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'profile_banner' => ['required'],
        ],[
            'profile_banner.required' => 'Veuillez sélectionner une image'
        ]);

        $file = $request->input('profile_banner');
        $file_path = Storage::move('tmp/'.$file, 'public/profiles/'.$file);

        $user->banner_path = $file;

        $user->save();

        return back()->with('status', 'banner-updated');
    }

    public function updateRole(User $user, Request $request)
    {
        $request->validate([
            'role_id' => ['required', 'string'],
        ],[
            'role_id.required' => 'Veuillez sélectionner un rôle',
            'role_id.string' => 'Veuillez sélectionner un rôle valide'
        ]);

        if(!in_array($request->role_id, ['user', 'modo', 'admin'])) {
            return back()->with('status', 'role-invalid');
        }

        $user->role_id = $request->role_id;

        $user->save();

        return back()->with('status', 'role-updated');
    }

    public function userBan(User $user)
    {
        $user->delete();

        return back()->with('status', 'user-ban');
    }

    public function userUnban(User $user)
    {
        $user->restore();

        return back()->with('status', 'user-ban');
    }
}
