<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

use App\Models\Tweet;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Return an array of hashtags
     * 
     * @param  string  $string
     * @return array
     */
    public function hashtags($string)
    {
        $keywords = array();

        /* Match hashtags */
        preg_match_all('/#(\w+)/', $string, $matches);
        
        /* Add all matches to array */
        foreach ($matches[1] as $match) {
            $keywords[] = $match;
        }
        return (array) $keywords;
    }

    /**
     * Return a string with hashtags links
     * 
     * @param  string  $string
     * @return string
     */
    public static function hashtag_links($string)
    {
        preg_match_all('/#(\w+)/', $string, $matches);

        foreach ($matches[1] as $match) {
            $string = str_replace("#$match", "<a href='". route('tweet.explorer', $match) ."' class='text-indigo-600 ml-1'>#$match</a>", "$string");
        }

        return $string;
    }

    /**
     * Sort an array by a specific key
     * 
     * @param  array  $array
     * @param  string  $on
     * @param  string  $order
     * 
     * @return array
     */
    function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();
    
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }
    
            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }
    
            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }
    
        return $new_array;
    }
    
    /**
     * Return an array of hashtags
     * 
     * @return array
     */
    public function rightbar()
    {
        $rightbar = Tweet::where('comments', null)
            ->where('created_at', '>=', now()->subHours(24))
            ->where('tweet', 'like', '%#%')
            ->with(['user', 'Likes'])
            ->orderBy('id', 'desc')
            // ->ddRawSql();
            ->get();
    
        $hashtags = array();
        $temp = array();
        foreach ($rightbar as $tweet)
        {
            $matchs = $this->hashtags($tweet->tweet);
            foreach ($matchs as $hashtag)
            {
                if (in_array($hashtag, $temp))
                {
                    $hashtags[$hashtag]['count']++;
                } else {
                    $hashtags[$hashtag] = [
                        'hashtag' => $hashtag,
                        'count' => 1,
                    ];
                    $temp[] = $hashtag;
                }
            }
        }

        return $this->array_sort($hashtags, 'count', SORT_DESC);
    }

    public function renderView($view, $data): View
    {
        $data['rightbar'] = array("hashtags" => $this->rightbar());

        $data['view'] = $view;

        return view('main', $data);
    }

    public function renderAdminView($view, $data): View
    {
        $data['view'] = $view;

        return view('admin', $data);
    }
}
