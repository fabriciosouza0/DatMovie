<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class SerieModel
{
    private static $tmdbApi;

    public static function detalhesDaSerie($serieId)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->detalhesDaSerie($serieId);
    }

    public static function SeriesRelacionadas($serieId) {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        return self::$tmdbApi->SeriesRelacionadas($serieId);
    }
}
