<?php

namespace app\Model;

use app\api\modules\TMDB_api;

require '../api/modules/TMDB_api.php';
require '../api/config/TMDB_config.php';

class LoadMoreModel
{
    private static $tmdbApi;
    private static $apiTarget;

    public static function load()
    {
        if (self::$tmdbApi == null) self::$tmdbApi = new TMDB_api();

        if (!isset($_GET['mediaType'])) return;
        if (!isset($_GET['page'])) return;
        if (!isset($_GET['order'])) return;
        if (!isset($_GET['genre'])) return;

        $mediaType = $_GET['mediaType'];
        $page = $_GET['page'];
        $order = $_GET['order'];
        $genre = $_GET['genre'];

        switch ($mediaType) {
            case 'filme':
                self::$apiTarget = 'movie';
                break;
            case 'serie':
                self::$apiTarget = 'tv';
                break;
            case 'anime':
                self::$apiTarget = 'tv';
                break;
        }

        $params = array(
            'language' => 'pt-BR',
            'sort_by' => $order,
            'with_genres' => $genre,
            'page' => $page
        );

        if ($mediaType == 'serie') {
            $params = array(
                'language' => 'pt-BR',
                'sort_by' => $order,
                'with_genres' => $genre,
                'without_genres' => '16',
                'page' => $page
            );
        }

        $data = self::$tmdbApi->request('discover/' . self::$apiTarget, $params);

        return json_encode($data);
    }
}

echo LoadMoreModel::load();
