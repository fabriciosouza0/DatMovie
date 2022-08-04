<?php

namespace app\Controller;

use app\lib\Config\Config;
use app\Model\DiscoverModel;

class DiscoverController extends ErroController
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
        $data = DiscoverModel::discover('movie', $this->page, $this->sort_by, $this->genre);
        $isEmpty = DiscoverModel::isEmpty();

        $params = array(
            'filmes' => $data,
            'page' => $this->page,
            'title' => Config::getPrefix() . 'Filmes',
            'generos' => DiscoverModel::generos('movie'),
            'order' => $this->sort_by,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, 3)
        );

        if ($isEmpty) {
            $template = $twig->load('error.html');

            $params = array(
                'title' => 'Página Inexistente'
            );
        }

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
        $data = DiscoverModel::discover('tv', $this->page, $this->sort_by, $this->genre);
        $isEmpty = DiscoverModel::isEmpty();

        $params = array(
            'series' => $data,
            'page' => $this->page,
            'title' => Config::getPrefix() . 'Séries',
            'generos' => DiscoverModel::generos('tv'),
            'order' => $this->sort_by,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, 3)
        );

        if ($isEmpty) {
            $template = $twig->load('error.html');

            $params = array(
                'title' => 'Página Inexistente'
            );
        }

        echo $twig->render($template, $params);
    }

    public function animes($page = 1, $sort_by = 'popularity.desc', $genre = null)
    {
        $this->page = $page;
        $this->sort_by = $sort_by;
        $this->genre = $genre;

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('animes.html');

        $this->getPost();
        $data = DiscoverModel::discover('tv', $this->page, $this->sort_by, '16,' . $this->genre);
        $isEmpty = DiscoverModel::isEmpty();

        $params = array(
            'series' => $data,
            'page' => $this->page,
            'title' => Config::getPrefix() . 'Animes',
            'generos' => DiscoverModel::generos('tv'),
            'order' => $this->sort_by,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, 3)
        );

        if ($isEmpty) {
            $template = $twig->load('error.html');

            $params = array(
                'title' => 'Página Inexistente'
            );
        }

        echo $twig->render($template, $params);
    }

    private function getPost()
    {
        if (sizeof($_POST) > 0) {
            if (isset($_POST['order'])) {
                $this->sort_by = 'popularity.asc';
            }

            if (isset($_POST['genero'])) {
                $this->genre = $_POST['genero'];
            }

            if (isset($_POST['page'])) {
                $this->page = $_POST['page'];
            }
        }
        echo $this->sort_by;
    }

    private function pagination($page, $total_pages)
    {
        $this->page = $page;

        if ($page < 0) $page = 1;

        $pagination = array(
            'before' => ($page - 1),
            'itens'  => array(),
            'next'   => ($page + 1)
        );

        $break = $total_pages;
        $values = array();

        if ($total_pages > 3) {
            $break = 3;
        }

        for ($i = $page; $i < ($page + $break); $i++) {
            $values[] .= $i;
        }
        $pagination['itens'] = $values;

        return $pagination;
    }
}
