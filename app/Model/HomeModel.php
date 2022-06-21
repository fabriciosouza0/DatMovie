<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class HomeModel
{
    private static $tmdbApi = null;

    public function __construct()
    {
        self::$tmdbApi = new TMDB_api();
    }

    public static function destaques()
    {
        return self::$tmdbApi->destaques();
    }

    public static function filmes_populares($page)
    {
        return self::$tmdbApi->filmesPopulares($page);
    }

    public static function series_populares($page)
    {
        return self::$tmdbApi->seriesPopulares($page);
    }
}
