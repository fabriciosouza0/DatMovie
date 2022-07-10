<?php

namespace app\Controller;

use app\lib\Config\Config;

class CadastroController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('cadastro.html');

        $params = array(
            'title' => Config::getPrefix() . 'Cadastro'
        );

        echo $twig->render($template, $params);
    }
}
