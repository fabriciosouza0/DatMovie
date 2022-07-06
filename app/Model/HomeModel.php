<?php

namespace app\Model;

use app\api\modules\TMDB_api;

abstract class HomeModel
{
    private static $tmdbApi;

    public static function destaques()
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->destaques();
    }

    public static function filmes_populares($page)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->filmesPopulares($page);
    }

    public static function series_populares($page)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->seriesPopulares($page);
    }

    public static function generos($target = 'movie') {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->generos($target);
    }
}
