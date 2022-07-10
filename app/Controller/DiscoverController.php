<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\DiscoverModel;

class DiscoverController
{
    private $page;
    private $sort_by;
    private $genre;

    public function filmes($page = 1, $sort_by = 'popularity.desc', $genre = null)
    {
        $this->page = $page;
        $this->sort_by = $sort_by;
        $this->genre = $genre;

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('filmes.html');

        $this->getPost();

        $params = array(
            'filmes' => DiscoverModel::discover('movie', $this->page, $this->sort_by, $this->genre),
            'page' => $this->page,
            'title' => Config::getPrefix() . 'Filmes',
            'generos' => DiscoverModel::generos('movie'),
            'order' => $this->sort_by,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, 3)
        );

        echo $twig->render($template, $params);
    }

    public function series($page = 1, $sort_by = 'popularity.desc', $genre = null)
    {
        $this->page = $page;
        $this->sort_by = $sort_by;
        $this->genre = $genre;

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('series.html');

        $this->getPost();

        $params = array(
            'series' => DiscoverModel::discover('tv', $this->page, $this->sort_by, $this->genre),
            'page' => $this->page,
            'title' => Config::getPrefix() . 'Séries',
            'generos' => DiscoverModel::generos('tv'),
            'order' => $this->sort_by,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, 3)
        );

        echo $twig->render($template, $params);
    }

    public function animes($page = 1, $sort_by = null, $genre = null)
    {
        $this->page = $page;
        $this->sort_by = $sort_by;
        $this->genre = $genre;

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('animes.html');

        $this->getPost();

        $params = array(
            'series' => DiscoverModel::discover('tv', $this->page, $this->sort_by, $this->genre),
            'page' => $this->page,
            'title' => Config::getPrefix() . 'Séries',
            'generos' => DiscoverModel::generos('tv'),
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, 3)
        );

        echo $twig->render($template, $params);
    }

    private function getPost()
    {
        if (sizeof($_POST) > 0) {
            if (isset($_POST['order']) && isset($_POST['genero'])) {
                $this->sort_by = $_POST['order'];
                $this->genre = $_POST['genero'];
            }
            if (isset($_POST['page'])) {
                $this->page = $_POST['page'];
            }
        }
    }

    private function pagination($page, $break)
    {
        if ($page < 0) $page = 1;

        $pagination = array(
            'before' => ($page - 1),
            'next' => ($page + 1),
            'itens' => array(),
            'break' => $break
        );

        for ($i = $page; $i < $page + $break; $i++) {
            $values[] = $i;
        }
        $pagination['itens'] = $values;

        return $pagination;
    }
}
