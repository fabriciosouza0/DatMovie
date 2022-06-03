<?php

namespace app\Core;

class Core
{
    private $controller;
    private $action;
    private $title;
    private $params;

    public function __construct()
    {
        $this->controller = 'app\Controller\HomeController';
        $this->action = 'index';
        $this->title = PREFIX . 'Home';
        $this->params = array();
    }

    public function start($url)
    {
        if (isset($url['url'])) {
            $url = explode('/', $url['url']);

            $this->controller = CONTROLLER . ucfirst($url[0]) . SUFIX;
            $this->title = PREFIX . ucfirst($url[0]);
            array_shift($url);

            if (isset($url[0]) && $url[0] != '') {
                $this->action = $url[0];
                array_shift($url);
            }

            if (!class_exists($this->controller)) {
                $this->controller = CONTROLLER . 'ErroController';
                $this->title = PREFIX . 'Página não encontrada';
            }

            $this->params = $url;
        }



        array_unshift($this->params, 'dark', $this->title);
        $this->controller = new $this->controller;

        if (!method_exists($this->controller, $this->action)) {
            $this->action = 'index';
        }

        call_user_func_array(array($this->controller, $this->action), $this->params);
    }
}
