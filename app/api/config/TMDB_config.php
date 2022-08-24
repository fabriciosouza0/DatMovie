<?php

namespace app\api\config;

abstract class TMDB_config
{
    private static $tmdbBaseUrl  = 'https://api.themoviedb.org/3/';
    private static $tmdbImageUrl = 'https://image.tmdb.org/t/p/';

    public static function getTmdbBaseUrl()
    {
        return self::$tmdbBaseUrl;
    }

    public static function getTmdbImageUrl()
    {
        return self::$tmdbImageUrl;
    }
}
