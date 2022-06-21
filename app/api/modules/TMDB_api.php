<?php

namespace app\api\modules;

use app\api\config\TMDB_config;
use Exception;

class TMDB_api
{
    private $key = null;
    private $error = null;

    public function __construct($key = null)
    {
        $this->key = TMDB_config::getTmdbApiKey();

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
            $responde = @file_get_contents($uri);
            return json_decode($responde, true);
        } else {
            $this->erro = true;
            throw new Exception('segundo parâmetro deve ser um array!');
        }
    }

    public function request_error()
    {
        return $this->error;
    }

    public function filmesPopulares($page)
    {
        $params = array(
            'page' => $page
        );
        try {
            $data = $this->request('movie/popular', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }
}
