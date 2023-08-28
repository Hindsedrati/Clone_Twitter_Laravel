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

use App\Notifications\RealTimeNotification;

use App\Models\Follow;
use App\Models\Tweet;
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
        $tweets = Tweet::whereIn('user_id', Auth::guard('user')->user()->followers->pluck('followed_user_id'))->latest()->with(['user', 'likes'])->paginate(10); // ->dumpRawSql();

        foreach ($tweets as $tweet)
        {
            $tweet->tweet = $this->hashtag_links($tweet->tweet);
        }

        return $this->renderView('tweet.followed', [ 'tweets' => $tweets ]);
    }

    public function store(User $user)
    {
        if (Auth::guard('user')->user()->id === $user->id) {
            return response('You cannot follow yourself...', 422);
        }

        if (Auth::guard('user')->user()->followers->pluck('follower_user_id')->contains($user->id)) {
            return response('You cannot follow more than one time', 409);
        }

        Follow::create([
            "follower_user_id" => $user->id,
            "followed_user_id" => Auth::guard('user')->user()->id,
        ]);

        $user->notify(
            new RealTimeNotification(
                '@'.Auth::guard('user')->user()->name.' vous a follow !',
                route('user.profile', ['user' => Auth::guard('user')->user()->name])
            )
        );

        return back();
    }

    public function destroy(User $user)
    {
        $follow = Follow::query()
                ->where('followed_user_id', auth()->id())
                ->where('follower_user_id', $user->id)
                ->first();

        if(!$follow)
        {
            abort(403);
        }

        $follow->delete();

        $user->notify(
            new RealTimeNotification(
                '@'.Auth::guard('user')->user()->name.' vous a unfollow !',
                route('user.profile', ['user' => Auth::guard('user')->user()->name])
            )
        );

        return back();
    }
}
