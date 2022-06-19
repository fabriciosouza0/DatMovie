<?php

namespace app\Controller;

use app\Model\LoginModel;

class LoginController
{
    const TITLE = PREFIX . 'Login';

    private $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('login.html');

        $params = array(
            'title' => PREFIX . 'Login'
        );

        echo $twig->render($template, $params);
    }

    public function login($email, $senha)
    {
        $this->login($email, $senha);
    }
}
