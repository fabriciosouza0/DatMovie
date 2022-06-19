<?php

namespace app\Controller;

use app\Model\HomeModel;

class HomeController
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        $data = array(
            'title' => PREFIX.'Home'
        );

        echo $twig->render($template, $data);;
    }

    private function fillContent() {
        HomeModel::getDestaques();
    }
}
