<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Tweet;

class UserController extends Controller
{
    /**
     * Display page register
     * 
     * @return View auth/register
     */
    public function registerView(): View
    {
        return view('auth/register');
    }

    /**
     * Store create account
     * 
     * @return Redirect dashboard
     */
    public function registerStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20', 'unique:'.User::class],
            'username' => ['required', 'string', 'min:3', 'max:35'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
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
            'password.required' => 'Veuillez entrer votre mot de passe',
            'password.confirmed' => 'Veuillez confirmer votre mot de passe',
            'password.min' => 'Votre mot de passe doit contenir au moins 8 caractères',
            'password.max' => 'Votre mot de passe doit contenir au maximum 255 caractères',
            'password.password' => 'Votre mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        Auth::login($user);

        return Redirect::route('tweet.dashboard');
    }

    /**
     * Display page login 
     * 
     * @return View auth/login
     */
    public function loginView(): View
    {
        return view('auth/login');
    }

    /**
     * Log user credential
     * 
     * @return Redirect dashboard
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ],[
            'email.required' => 'Veuillez entrer votre adresse email',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'password.required' => 'Veuillez entrer votre mot de passe',
            'password.min' => 'Votre mot de passe doit contenir au moins 6 caractères',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = auth("user")->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Adresse email ou mot de passe incorrect',
            ]);
        }

        return Redirect::route('tweet.dashboard')->with(['token' => $token]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return Redirect dashboard
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('tweet.dashboard');
    }

    /**
     * Display page profile
     * 
     * @return View user/profile
     */
    public function userProfileView(Request $request): View
    {
        $profile = User::where('name', $request->name)->firstOrFail();

        $tweets = $profile->tweets()
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        foreach ($tweets as $tweet)
        {
            $tweet->tweet = $this->hashtag_links($tweet->tweet);
        }

        return $this->renderView('user.profile', [ 'profile' => $profile, 'tweets' => $tweets, ]);
    }
}
