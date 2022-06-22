<?php

namespace app\Controller;

use app\lib\config\Config;

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

        $params = array(
            'title' => Config::getPrefix() . 'Página Inexistente'
        );

        echo $twig->render($template, $params);
    }
}
