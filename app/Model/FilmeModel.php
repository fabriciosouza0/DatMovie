<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class FilmeModel
{
    private static $tmdbApi;

    public static function detalhes($filmeId)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->detalhesDoFilme($filmeId);
    }

    public static function FilmesRelacionados($filmeId) {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->FilmesRelacionados($filmeId);
    }

    public static function getError()
    {
        return self::$tmdbApi->request_error();
    }
}
