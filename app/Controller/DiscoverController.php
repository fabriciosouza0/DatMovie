<?php

namespace app\Controller;

use app\Model\DiscoverModel;

class DiscoverController extends ErroController
{
    private $page;
    private $order;
    private $genre;
    private $media_type;

    public function filmes($page = 1, $order = 'popularity.desc', $genre = null)
    {
        $this->page = $page;
        $this->order = $order;
        $this->genre = $genre;
        $this->media_type = 'filme';

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('discover.html');

        $this->getParams();
        $data = DiscoverModel::discover('movie', 'filme', $this->page, $this->order, $this->genre);
        $isEmpty = DiscoverModel::isEmpty();

        $params = array(
            'media_type' => $this->media_type,
            'data' => $data,
            'page' => $this->page,
            'title' => 'Filmes',
            'generos' => DiscoverModel::generos('movie'),
            'order' => $this->order,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, $data['total_pages'])
        );

        if ($isEmpty) {
            $template = $twig->load('error.html');

            $params = array(
                'title' => 'Página Inexistente'
            );
        }

        echo $twig->render($template, $params);
    }

    public function series($page = 1, $order = 'popularity.desc', $genre = null)
    {
        $this->page = $page;
        $this->order = $order;
        $this->genre = $genre;
        $this->media_type = 'serie';

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('discover.html');

        $this->getParams();
        $data = DiscoverModel::discover('tv', 'serie', $this->page, $this->order, $this->genre);
        $isEmpty = DiscoverModel::isEmpty();

        $params = array(
            'media_type' => $this->media_type,
            'data' => $data,
            'page' => $this->page,
            'title' => 'Séries',
            'generos' => DiscoverModel::generos('tv'),
            'order' => $this->order,
            'genre' => $this->genre,
            'pagination' => $this->pagination($this->page, $data['total_pages'])
        );

        if ($isEmpty || $genre == 16) {
            $template = $twig->load('error.html');

            $params = array(
                'title' => 'Página Inexistente'
            );
        }

        echo $twig->render($template, $params);
    }

    public function animes($page = 1, $order = 'popularity.desc', $genre = null)
    {
        $this->page = $page;
        $this->order = $order;
        $this->genre = $genre;
        $this->media_type = 'anime';

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('discover.html');

        $this->getParams();
        $data = DiscoverModel::discover('tv', 'anime', $this->page, $this->order, '16,' . $this->genre);
        $isEmpty = DiscoverModel::isEmpty();

        $params = array(
            'media_type' => $this->media_type,
            'data' => $data,
            'page' => $this->page,
            'title' => 'Animes',
            'generos' => DiscoverModel::generos('tv'),
            'order' => $this->order,
            'genre' => $this->genre,
            'defaultGenre' => '16',
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

    private function getParams()
    {
        $this->genre = isset($_GET['genre']) ? $_GET['genre'] : null;
        $this->order = isset($_GET['order']) ? $_GET['order'] : '';
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
    }

    private function pagination($page, $total_pages)
    {
        $this->page = $page;

        if ($page < 0) $page = 1;

        $pagination = array(
            'start' => 1,
            'before' => ($page - 1),
            'itens'  => array(),
            'next'   => ($page + 1),
            'end' => $total_pages
        );

        $break = $total_pages;
        $pages = range(1, $total_pages);




        /* foreach ($pages as $key => $value) {
            # code...
        } */

        /* for ($i = $page; $i < ($page + $break); $i++) {
            $values[] .= $i;
            if($i == $total_pages || $page == $total_pages) break;
        }
        $pagination['itens'] = $values; */

        return $pagination;
    }
}
