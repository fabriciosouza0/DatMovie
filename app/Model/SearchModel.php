<?php

namespace app\Model;

use app\api\modules\TMDB_api;

class SearchModel
{
    private static $tmdbApi;

    public static function search($search, $page = 1, $include_adult = true)
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();

        $params = array(
            'language' => 'pt-BR',
            'query' => urlencode($search),
            'page' => $page,
            'include_adult' => $include_adult
        );

        $data = self::$tmdbApi->request('search/multi', $params);

        return $data;
    }

    public static function isEmpty()
    {
        return self::$tmdbApi->isEmpty();
    }
}
