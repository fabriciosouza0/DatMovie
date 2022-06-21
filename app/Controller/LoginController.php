<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\LoginModel;

class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('login.html');

        $params = array(
            'title' => Config::getPrefix() . 'Login'
        );

        echo $twig->render($template, $params);
    }

    public function login($email, $senha)
    {
        $this->loginModel->login($email, $senha);
    }
}
