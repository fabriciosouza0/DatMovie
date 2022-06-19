<?php

namespace app\Controller;

class CadastroController
{
    const TITLE = PREFIX.'Cadastro';

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('cadastro.html');

        $params = array(
            'title' => $this->TITLE
        );

        echo $twig->render($template, $params);
    }
}
