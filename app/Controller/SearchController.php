<?php

namespace app\Controller;

use app\Model\SearchModel;

class SearchController extends ErroController
{
    private $page;
    private $search;

    public function all($search = null, $page = 1)
    {
        $this->search = $search;
        $this->page = $page;

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('search.html');

        $this->getRequest();
        $data = SearchModel::search($this->search, $this->page);
        $isEmpty = SearchModel::isEmpty();

        $params = array(
            'isEmpty' => $isEmpty,
            'all' => SearchModel::search($this->search, $this->page),
            'page' => $this->page,
            'title' => 'Pesquisar por: ' . $this->search,
            'search' => $this->search,
            'pagination' => $this->pagination($this->page, $data['total_pages'])
        );

        echo $twig->render($template, $params);
    }

    private function getRequest()
    {
        if (sizeof($_GET) > 0) {
            if (isset($_GET['search'])) {
                $this->search = $_GET['search'];
            }
            if (isset($_GET['page'])) {
                $this->page = $_GET['page'];
            }
        }
    }

    private function pagination($page, $total_pages)
    {
        $this->page = $page;

        if ($this->page <= 0) {
            $this->page = 1;
        } elseif ($this->page >= $total_pages) {
            $this->page = $total_pages;
        }

        $pagination = array(
            'before' => ($this->page - 1),
            'itens'  => array(),
            'next'   => ($this->page + 1)
        );

        $break = $total_pages;
        $values = array();

        if ($total_pages > 3) {
            $break = 3;
        }

        for ($i = $this->page; $i < ($this->page + $break); $i++) {
            $values[] .= $i;
            if ($this->page == $total_pages || $i == $total_pages) break;
        }
        $pagination['itens'] = $values;

        return $pagination;
    }
}
