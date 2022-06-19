<?php

namespace app\Controller;

class ErroController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('error.html');

        $params = array(
            'title' => PREFIX.'Página Inexistente'
        );

        echo $twig->render($template, $params);
    }
}
