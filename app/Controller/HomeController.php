<?php

namespace app\Controller;

use app\lib\Config\Config;
use app\Model\HomeModel;

class HomeController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        $data = array(
            'destaques' => HomeModel::destaques(),
            'filmes_populares' => HomeModel::getMedias('movie','popular',1),
            'series_populares' => HomeModel::getMedias('tv','popular',1),
            'melhores_filmes' => HomeModel::getMedias('movie','top_rated',1),
            'melhores_series' => HomeModel::getMedias('tv','top_rated',1),
            'title' => Config::getPrefix() . 'Home'
        );

        echo $twig->render($template, $data);;
    }
}
