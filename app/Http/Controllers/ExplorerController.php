<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
            ->where('tweet', 'like', '%#'.$string.'%')
            ->with(['user', 'Likes'])
            ->orderBy('id', 'desc')
            // ->ddRawSql();
            ->paginate(10);

        foreach ($tweets as $tweet)
        {
            $tweet->tweet = $this->hashtag_links($tweet->tweet);
        }

        return $this->renderView('tweet.explorer', [ 'tweets' => $tweets ]);
    }
}
