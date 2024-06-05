<?php

namespace app\api\modules;

use app\api\config\TMDB_config;

class TMDB_api
{
    private $key;
    private $isEmpty;
    private $pagination;

    public function __construct($key = null)
    {
        $this->key = getenv('ApiKey');
        $this->isEmpty = false;

        $this->pagination = array(
            'before' => 1,
            'index' => 1,
            'after' => 2,
            'pages' => []
        );

        if (!empty($key)) {
            $this->key = $key;
        }
    }

    public function request($endpoint, $params = array())
    {
        $baseUrl = TMDB_config::getTmdbBaseUrl();
        $key = $this->key;
        $uri = $baseUrl . $endpoint . '?api_key=' . $key;

        if (is_array($params)) {
            $uri .= '&';

            foreach ($params as $key => $value) {
                if (empty($value)) continue;

                $uri .= $key . '=' . urlencode($value) . '&';
            }

            $uri = substr($uri, 0, -1);
            $response = json_decode(@file_get_contents($uri), true);

            if (!is_array($response)) {
                $this->isEmpty = true;
            } elseif (isset($response['results'])) {
                if (sizeof($response['results']) < 1) {
                    $this->isEmpty = true;
                } else {
                    foreach ($response['results'] as $key => $media) {
                        if (isset($media["vote_average"])) {
                            $vote_average = $media["vote_average"];
                            $rate = round($vote_average, 1);

                            $response['results'][$key]["vote_average"] = $rate;
                        }
                    }
                }
            }

            return $response;
        } else {
            $this->isEmpty = true;
        }
    }

    public function isEmpty()
    {
        return $this->isEmpty;
    }
}
