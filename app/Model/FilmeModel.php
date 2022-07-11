<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class FilmeModel
{
    private static $tmdbApi;

    public static function detalhes($id)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR'
        );

        $data = self::$tmdbApi->request('movie/' . $id, $params);

        return $data;
    }

    public static function FilmesRelacionados($id) {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR',
            'page' => 1
        );

        $data = self::$tmdbApi->request('movie/' . $id . '/similar', $params);

        return $data;
    }

    public static function isEmpty()
    {
        return self::$tmdbApi->isEmpty();
    }
}
