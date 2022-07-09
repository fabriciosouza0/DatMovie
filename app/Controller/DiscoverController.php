<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\DiscoverModel;

class DiscoverController
{
    public function filmes($sort_by = null, $genre = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('filmes.html');

        $params = array(
            'filmes' => DiscoverModel::discover('movie', $sort_by, $genre),
            'title' => Config::getPrefix() . 'Filmes',
            'generos' => DiscoverModel::generos('movie')
        );

        echo $twig->render($template, $params);
    }

    public function series($sort_by = null, $genre = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('series.html');

        $params = array(
            'series' => DiscoverModel::discover('tv', $sort_by, $genre),
            'title' => Config::getPrefix() . 'Séries',
            'generos' => DiscoverModel::generos('tv')
        );

        echo $twig->render($template, $params);
    }

    public function animes($sort_by = 'popularidade', $genre = '')
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('animes.html');

        $params = array(
            'series' => DiscoverModel::discover('tv', $sort_by, $genre),
            'title' => Config::getPrefix() . 'Animes',
            'generos' => DiscoverModel::generos('tv')
        );

        echo $twig->render($template, $params);
    }

    private function getPost()
    {
        if(!isset($_POST) || sizeof($_POST)) {

        }
    }
}
