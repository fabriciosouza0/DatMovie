<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class DetalhesModel
{
    private static $tmdbApi;

    public static function detalhes($mediaType, $id)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR'
        );

        $data = self::$tmdbApi->request($mediaType . '/' . $id, $params);

        if ($mediaType == 'tv') {
            $imdb_id = self::$tmdbApi->request($mediaType . '/' . $id . '/external_ids', $params);
            array_unshift($data, $imdb_id['imdb_id']);
        }

        return $data;
    }

    public static function relacionados($mediaType, $id)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR',
            'page' => 1
        );

        $data = self::$tmdbApi->request($mediaType . '/' . $id . '/similar', $params);

        return $data;
    }

    public static function isEmpty()
    {
        return self::$tmdbApi->isEmpty();
    }
}
