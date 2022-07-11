<?php

namespace app\api\modules;

use app\api\config\TMDB_config;

class TMDB_api
{
    private $key;
    private $isEmpty;

    public function __construct($key = null)
    {
        $this->key = TMDB_config::getTmdbApiKey();
        $this->isEmpty = false;

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
                if (sizeof($response['results']) < 1) $this->isEmpty = true;
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
