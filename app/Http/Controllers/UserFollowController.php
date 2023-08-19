<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\Follow;
use App\Models\User;

class UserFollowController extends Controller
{
    public function store(User $user)
    {
        if (Auth::guard('user')->user()->id === $user->id) {
            return response('You cannot follow yourself...', 422);
        }

        Follow::create([
            "follower_user_id" => Auth::guard('user')->user()->id,
            "followed_user_id" => $user->id,
        ]); 

        return back();
    }

    public function destroy(User $user, Follow $follow)
    {
        return back();
    }
}
