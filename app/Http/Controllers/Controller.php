<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
    public function hashtag_links($string)
    {
        preg_match_all('/#(\w+)/', $string, $matches);

        foreach ($matches[1] as $match) {
            $string = str_replace("#$match", "<a href='". route('tweet.explorer', $match) ."' class='text-indigo-600 ml-1'>#$match</a>", "$string");
        }

        return $string;
    }
}
