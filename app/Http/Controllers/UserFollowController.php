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
    /**
     * Display a listing followed of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function dashboardFollowed(): View
    {
        $tweets = Tweet::whereIn('user_id', Auth::guard('user')->user()->following->pluck('id'))->latest()->with(['user', 'likes'])->paginate(10); // ->dumpRawSql();

        return $this->renderView('tweet.followed', [ 'tweets' => $tweets ]);
    }

    public function store(User $user)
    {
        if (Auth::guard('user')->user()->id === $user->id) {
            return response('You cannot follow yourself...', 422);
        }

        if (Auth::guard('user')->user()->following->contains($user->id)) {
            return response('You cannot follow more than one time', 409);
        }

        Follow::create([
            "follower_user_id" => Auth::guard('user')->user()->id,
            "followed_user_id" => $user->id,
        ]); 

        return back();
    }

    public function destroy(User $user)
    {
        $follow = Follow::query()
                ->where('follower_user_id', auth()->id())
                ->where('followed_user_id', $user->id)
                ->first();

        $follow->delete();

        return back();
    }
}
