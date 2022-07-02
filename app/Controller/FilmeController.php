<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\FilmeModel;

class FilmeController
{
    public function assistir($filmeId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('assistir-filme.html');

        $params = array(
            'title' => Config::getPrefix() . 'Página Inexistente'
        );

        echo $twig->render($template, $params);
    }

    public function detalhes($filmeId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('detalhes-filme.html');

        $filme = FilmeModel::detalhes($filmeId);

        $params = array(
            'title' => $filme['title'],
            'poster' => 'https://image.tmdb.org/t/p/original' . $filme['poster_path'],
            'imdbId' => $filme['imdb_id']
        );


        echo $twig->render($template, $params);
    }
}
