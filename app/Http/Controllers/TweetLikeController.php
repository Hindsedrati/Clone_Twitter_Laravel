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

use App\Models\Like;
use App\Models\User;
use App\Models\Tweet;

class TweetLikeController extends Controller
{
    public function addTweetLikes(Tweet $tweet, Request $request)
    {
        if ($tweet->likedBy(Auth::guard('user')->user())) {
            return response(null, 409);
        }

        $tweet->likes()->create([
            'user_id' => Auth::guard('user')->user()->id,
        ]);

        return back();
    }

    public function destroyTweetLikes(Tweet $tweet, Request $request)
    {
        Auth::guard('user')->user()->likes()->where('tweet_uuid', $tweet->uuid)->delete();

        return back();
    }
}
