<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class DiscoverModel
{
    private static $tmdbApi;

    public static function discover($target, $page = 1, $sort_by, $with_genres, $include_adult = true, $include_video = false)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->discover($target, $page, $sort_by, $with_genres);
    }

    public static function generos($target = 'movie')
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->generos($target);
    }
}
