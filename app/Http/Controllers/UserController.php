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
    public function registerStore(Request $request): Redirect
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:'.User::class],
            'pseudo' => ['required', 'string', 'max:65'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'name.unique' => 'Ce nom est déjà utilisée',
            'name.required' => 'Le nom est obligatoire',
            'name.string' => 'Le nom doit être une chaine de caractères',
            'name.max' => 'Le nom ne doit pas dépasser 50 caractères',
            'pseudo.required' => 'Le nom est obligatoire',
            'pseudo.string' => 'Le nom doit être une chaine de caractères',
            'nampseudoe.max' => 'Le nom ne doit pas dépasser 50 caractères',
            'email.required' => 'L\'adresse mail est obligatoire',
            'email.email' => 'L\'email doit être valide',
            'email.unique' => 'Cette adresse mail est déjà utilisée',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
        ]);

        $user = User::create([
            'name' => $request->name,
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        Auth::login($user);

        return Redirect::route('tweets.dashboard');
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
    public function login(Request $request): Redirect
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

        return Redirect::route('tweets.dashboard')->with(['token' => $token]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return Redirect dashboard
     */
    public function logout() {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('tweets.dashboard');
    }
}
