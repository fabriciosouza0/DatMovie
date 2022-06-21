<?php

namespace app\Controller;

use app\lib\config\Config;

class ErroController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('error.html');

        $params = array(
            'title' => Config::getPrefix() . 'Página Inexistente'
        );

        echo $twig->render($template, $params);
    }
}
