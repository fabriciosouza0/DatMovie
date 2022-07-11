<?php

namespace app\Model;

use app\api\modules\TMDB_api;

abstract class HomeModel
{
    private static $tmdbApi;

    public static function destaques($qtd = 3)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR',
        );

        $data = self::$tmdbApi->request('movie/top_rated', $params);
        shuffle($data['results']);
        $destaques = array();

        for ($i = 0; $i < $qtd; $i++) {
            array_push($destaques, $data['results'][$i]);
        }

        return $destaques;
    }

    public static function getMedias($target, $section, $page)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR',
            'page' => $page
        );

        $data = self::$tmdbApi->request($target . '/' . $section, $params);

        return $data;
    }
}
