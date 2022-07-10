<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class SearchModel
{
    private static $tmdbApi;

    public static function search($search, $page = 1)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->search($search, $page);
    }
}
