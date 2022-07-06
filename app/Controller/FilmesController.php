<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\FilmeModel;
use app\Model\HomeModel;

class FilmesController
{
    public function index($orderBy = 'popularidade', $genero = '')
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('filmes.html');

        $params = array(
            'filmes' => HomeModel::filmes_populares(1),
            'title' => Config::getPrefix() . 'Filmes',
            'generos' => HomeModel::generos('movie')
        );
        
        echo $twig->render($template, $params);
    }
}
