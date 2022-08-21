<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class DiscoverModel
{
    private static $tmdbApi;

    public static function discover($target = 'movie', $mediaType = 'filme', $page = 1, $order = 'popularity.desc', $with_genres = null, $include_adult = false, $include_video = false)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();

        $params = array(
            'language' => 'pt-BR',
            'sort_by' => $order,
            'with_genres' => $with_genres,
            'include_adult' => $include_adult,
            'include_video' => $include_video,
            'page' => $page
        );

        if ($mediaType == 'serie') {
            $params = array(
                'language' => 'pt-BR',
                'sort_by' => $order,
                'with_genres' => $with_genres,
                'without_genres' => '16',
                'page' => $page
            );
        }

        $data = self::$tmdbApi->request('discover/' . $target, $params);

        return $data;
    }

    public static function generos($target)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();
        $params = array(
            'language' => 'pt-BR'
        );

        $data = self::$tmdbApi->request('genre/' . $target . '/list', $params);

        return $data;
    }

    public static function isEmpty()
    {
        return self::$tmdbApi->isEmpty();
    }
}
