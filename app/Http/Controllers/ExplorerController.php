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

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function explorerView(String $string): View
    {
        $tweets = Tweet::where('comments', null)
            ->where('tweet', 'like', '%#%')
            ->with(['user', 'Likes'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        foreach ($tweets as $tweet)
        {
            $tweet->tweet = $this->hashtag_links($tweet->tweet);
        }

        return view('explorer', [ 'tweets' => $tweets ]);
    }
}
