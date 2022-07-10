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
            'filmes_populares' => HomeModel::filmes_populares(1),
            'series_populares' => HomeModel::series_populares(1),
            'title' => Config::getPrefix() . 'Home'
        );

        echo $twig->render($template, $data);;
    }
}
