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
}
