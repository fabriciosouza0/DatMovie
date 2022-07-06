<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\FilmeModel;
use app\Model\HomeModel;

class SeriesController
{
    public function index($orderBy = 'popularidade', $genero = '')
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('series.html');

        $params = array(
            'series' => HomeModel::series_populares(1),
            'title' => Config::getPrefix() . 'Séries',
            'generos' => HomeModel::generos('tv')
        );
        
        echo $twig->render($template, $params);
    }
}
