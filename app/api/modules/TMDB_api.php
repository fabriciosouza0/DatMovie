<?php

namespace app\api\modules;

use app\api\config\TMDB_config;
use Exception;

class TMDB_api
{
    private $key;
    private $error;

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
            $response = json_decode(@file_get_contents($uri), true);

            if (!is_array($response)) {
                $this->erro = true;
            } elseif (sizeof($response) < 1) {
                $this->erro = true;
            }

            return $response;
        } else {
            $this->erro = true;
            throw new Exception('segundo parâmetro deve ser um array!');
        }
    }

    public function request_error()
    {
        return $this->error;
    }

    public function destaques($qtd = 3)
    {
        $params = array(
            'language' => 'pt-BR',
        );

        try {
            $data = $this->request('movie/top_rated', $params);
        } catch (Exception $e) {
            $this->error = true;
            return $e->getMessage();
        }
        shuffle($data['results']);
        $destaques = array();

        for ($i = 0; $i < $qtd; $i++) {
            array_push($destaques, $data['results'][$i]);
        }

        return $destaques;
    }

    public function filmesPopulares($page)
    {
        $params = array(
            'language' => 'pt-BR',
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

    public function seriesPopulares($page)
    {
        $params = array(
            'language' => 'pt-BR',
            'page' => $page
        );
        try {
            $data = $this->request('tv/popular', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }

    public function detalhesDoFilme($id)
    {
        $params = array(
            'language' => 'pt-BR'
        );

        try {
            $data = $this->request('movie/' . $id, $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }

    public function FilmesRelacionados($filmeId)
    {
        $params = array(
            'language' => 'pt-BR',
            'page' => 1
        );

        $data = $this->request('movie/' . $filmeId . '/similar', $params);

        if (!is_array($data)) {
            $this->error = true;
        } elseif (sizeof($data) < 1) {
            $this->error = true;
        }

        return $data;
    }

    public function detalhesDaSerie($id)
    {
        $params = array(
            'language' => 'pt-BR'
        );

        $data = $this->request('tv/' . $id, $params);

        if (!is_array($data)) {
            $this->error = true;
        } elseif (sizeof($data) < 1) {
            $this->error = true;
        } else {
            $imdb_id = $this->request('tv/' . $id . '/external_ids', $params);
            array_unshift($data, $imdb_id['imdb_id']);
        }

        return $data;
    }

    public function SeriesRelacionadas($serieId)
    {
        $params = array(
            'language' => 'pt-BR',
            'page' => 1
        );

        try {
            $data = $this->request('tv/' . $serieId . '/similar', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }

    public function generos($target = 'movie')
    {
        $params = array(
            'language' => 'pt-BR'
        );

        try {
            $data = $this->request('genre/' . $target . '/list', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }

    public function discover($target = 'movie', $page = 1, $sort_by = 'popularity.desc', $with_genres = null, $include_adult = false, $include_video = false)
    {
        $params = array(
            'language' => 'pt-BR',
            'sort_by' => $sort_by,
            'with_genres' => $with_genres,
            'include_adult' => $include_adult,
            'include_video' => $include_video,
            'page' => $page
        );

        try {
            $data = $this->request('discover/' . $target, $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }

    public function search($search, $page = 1, $include_adult = true)
    {
        $params = array(
            'language' => 'pt-BR',
            'query' => urlencode($search),
            'page' => $page,
            'include_adult' => $include_adult
        );

        try {
            $data = $this->request('search/multi', $params);
        } catch (Exception $e) {
            $this->erro = true;
            return $e->getMessage();
        }

        return $data;
    }
}
