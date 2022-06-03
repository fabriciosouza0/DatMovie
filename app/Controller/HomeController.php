<?php

namespace app\Controller;

class HomeController
{
    public function index($theme, $title)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        $data = array(
            'theme' => $theme,
            'title' => $title
        );

        echo $twig->render($template, $data);;
    }
}
