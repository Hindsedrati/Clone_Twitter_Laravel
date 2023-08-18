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

use App\Models\Analytic;
use App\Models\Like;
use App\Models\User;
use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(): View
    {
        $tweets = Tweet::where('comments', null)
            // ->with(['user', 'Likes'])
            ->orderBy('id', 'desc')
            ->paginate(10);
            // ->take(300)
            // ->get();

        if (Auth::id()) {
            foreach ($tweets as $tweet) {
                if (!$tweet->AnalyticsBy(Auth::guard('user')->user())) {
                    $tweet->Analytics()->create([
                        'user_id' => Auth::guard('user')->user()->id,
                    ]);
                }
            }
        }

        return view('dashboard', [ 'tweets' => $tweets ]);
    }

    /**
     * Store a newsly created tweet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function addTweet(Request $request): RedirectResponse
    {
        $request->validate([
            'tweet' => 'required|string|max:144',
        ], [
            'tweet.required' => 'Veuillez entrer votre tweet',
            'tweet.string' => 'Veuillez entrer une valeur valide',
            'tweet.max' => 'Votre tweet ne doit pas dépasser 144 caractères',
        ]);

        $file = null;
        $extension = null;
        $fileName = null;
        $path = '';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $request->validate([ 'file' => 'required|mimes:jpg,jpeg,png,mp4' ]);
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $extension === 'mp4' ? $path = '/videos/' : $path = '/pics/';
        }

        $tweet = new Tweet;

        $tweet->uuid = Str::ulid();
        $tweet->user_id = Auth::guard('user')->user()->id;
        $tweet->handle = '';
        $tweet->image = '';
        $tweet->tweet = $request->input('tweet');
        if ($fileName) {
            $tweet->file = $path . $fileName;
            $tweet->is_video = $extension === 'mp4' ? true : false;
            $file->move(public_path() . $path, $fileName);
        }

        $tweet->save();

        return Redirect::route('tweets.dashboard');
    }

    /**
     * Store a newly created tweet comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function addTweetComment(Tweet $tweet, Request $request): RedirectResponse
    {
        // $tweet = Tweet::where('uuid', $request->uuid)->first();

        if (!$tweet) {
            return back()->withErrors([
                'tweet' => 'Tweet introuvable',
            ]);
        }

        $request->validate([
            'tweet' => 'required|string|max:144',
        ], [
            'tweet.required' => 'Veuillez entrer votre tweet',
            'tweet.string' => 'Veuillez entrer une valeur valide',
            'tweet.max' => 'Votre tweet ne doit pas dépasser 144 caractères',
        ]);

        $file = null;
        $extension = null;
        $fileName = null;
        $path = '';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $request->validate([ 'file' => 'required|mimes:jpg,jpeg,png,mp4' ]);
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $extension === 'mp4' ? $path = '/videos/' : $path = '/pics/';
        }

        $tweetComment = new Tweet;

        $tweetComment->uuid = Str::ulid();
        $tweetComment->user_id = Auth::guard('user')->user()->id;
        $tweetComment->handle = '';
        $tweetComment->image = '';
        $tweetComment->tweet = $request->input('tweet');
        if ($fileName) {
            $tweetComment->file = $path . $fileName;
            $tweetComment->is_video = $extension === 'mp4' ? true : false;
            $file->move(public_path() . $path, $fileName);
        }
        $tweetComment->comments = $tweet->uuid;

        $tweetComment->save();

        return Redirect::route('tweet.comments', $tweet->uuid);
    }

    /**
     * Display tweet retweet
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function tweetRetweetView(Request $request): View
    {
        $tweet = Tweet::where('uuid', $request->uuid)->first();

        return view('tweet/retweet', [ 'tweet' => $tweet ]);
    }

    /**
     * Store a newly created tweet retweet in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function addTweetRetweet(Tweet $tweet, Request $request): RedirectResponse
    {
        // $tweet = Tweet::where('uuid', $request->uuid)->first();

        if (!$tweet) {
            abort(403);
        }

        $file = null;
        $extension = null;
        $fileName = null;
        $path = '';

        $tweetRetweet = new Tweet;

        $tweetRetweet->uuid = Str::ulid();
        $tweetRetweet->user_id = Auth::guard('user')->user()->id;
        $tweetRetweet->handle = '';
        $tweetRetweet->image = '';
        $tweetRetweet->tweet = $request->tweet;

        $tweetRetweet->Retweets = $tweet->uuid;

        $tweetRetweet->save();

        return Redirect::route('tweets.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $uuid
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function destroy($uuid): RedirectResponse
    {
        $tweet = Tweet::find($uuid);

        if (!is_null($tweet->file) && file_exists(public_path() . $tweet->file)) {
            unlink(public_path() . $tweet->file);
        }

        $tweet->delete();

        return Redirect::route('tweets.dashboard');
    }

    /**
     * Display tweet comments
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function tweetCommentsView(Request $request): View
    {
        $tweet = Tweet::where('uuid', $request->uuid)->first();

        $comments = Tweet::where('comments', $request->uuid)->with(['user', 'Likes'])
            ->orderBy('id', 'desc')
            ->paginate(10);
            // ->get();

        return view('tweet/comments', [ 'tweet' => $tweet, 'comments' => $comments ]);
    }
}
