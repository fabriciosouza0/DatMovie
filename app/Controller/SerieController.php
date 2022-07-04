<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\SerieModel;

class SerieController
{
    public function assistir($serieId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('assistir-serie.html');

        $params = array(
            'title' => Config::getPrefix() . 'Página Inexistente'
        );

        echo $twig->render($template, $params);
    }

    public function detalhes($serieId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('detalhes-serie.html');

        $serie = SerieModel::detalhesDaSerie($serieId);

        $params = array(
            'title' => $serie['name'],
            'imdbId' => $serie[0],
            'data-estreia' => $serie['first_air_date'],
            'data-fim' => $serie['last_air_date'],
            'poster' => 'https://image.tmdb.org/t/p/original' . $serie['poster_path'],
            'backdrop' => 'https://image.tmdb.org/t/p/original' . $serie['backdrop_path'],
            'tagline' => $serie['tagline'],
            'desc' => $serie['overview'],
            'relacionados' => SerieModel::SeriesRelacionadas($serieId)
        );

        echo $twig->render($template, $params);
    }
}
