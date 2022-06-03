<?php

namespace app\Controller;

class CadastroController
{

    public function index($theme, $title)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('cadastro.html');

        $params = array(
            'theme' => $theme,
            'title' => $title
        );

        echo $twig->render($template, $params);
    }
}
