<?php

namespace app\Controller;

class LoginController
{
    private $authUser;

    public function __construct()
    {
    }

    public function index($theme, $title)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('login.html');

        $params = array(
            'theme' => $theme,
            'title' => $title
        );

        echo $twig->render($template, $params);
    }

    public function login($email, $senha)
    {
    }
}
