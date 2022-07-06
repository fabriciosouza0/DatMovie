<?php

namespace app\Controller;

use app\Model\FilmeModel;

class FilmeController
{
    public function detalhes($filmeId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('detalhes-filme.html');

        $filme = FilmeModel::detalhes($filmeId);
        $overview = strlen($filme['overview']) > 230 ? substr($filme['overview'], 0, 230) . '...' : $filme['overview'];

        $params = array(
            'title' => $filme['title'],
            'poster' => 'https://image.tmdb.org/t/p/original' . $filme['poster_path'],
            'backdrop' => 'https://image.tmdb.org/t/p/original' . $filme['backdrop_path'],
            'imdbId' => $filme['imdb_id'],
            'tagline' => $filme['tagline'],
            'desc' => $overview,
            'time' => $filme['runtime'],
            'ano' => substr($filme['release_date'], 0, 4),
            'relacionados' => FilmeModel::FilmesRelacionados($filmeId)
        );

        echo $twig->render($template, $params);
    }
}
