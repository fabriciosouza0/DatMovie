<?php

namespace app\Controller;

class CadastroController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('cadastro.html');

        $params = array(
            'title' => 'Cadastro'
        );

        echo $twig->render($template, $params);
    }
}
