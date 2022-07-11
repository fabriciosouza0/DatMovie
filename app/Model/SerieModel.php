<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class SerieModel
{
    private static $tmdbApi;

    public static function detalhesDaSerie($id)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR'
        );

        $data = self::$tmdbApi->request('tv/' . $id, $params);

        $imdb_id = self::$tmdbApi->request('tv/' . $id . '/external_ids', $params);
        array_unshift($data, $imdb_id['imdb_id']);

        return $data;
    }

    public static function SeriesRelacionadas($id)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR',
            'page' => 1
        );

        $data = self::$tmdbApi->request('tv/' . $id . '/similar', $params);

        return $data;
    }

    public static function isEmpty()
    {
        return self::$tmdbApi->isEmpty();
    }
}
