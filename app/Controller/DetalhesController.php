<?php

namespace app\Controller;

use app\Model\DetalhesModel;

class DetalhesController extends ErroController
{
    public function filme($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('detalhes.html');

        $data = DetalhesModel::detalhes('movie', $id);

        if (DetalhesModel::isEmpty()) {
            $params = array(
                'title' => 'Página Inexistente'
            );

            $template = $twig->load('error.html');
        } else {
            $overview = strlen($data['overview']) > 230 ? substr($data['overview'], 0, 230) . '...' : $data['overview'];
            $poster = $data['poster_path'] ? 'https://image.tmdb.org/t/p/original' . $data['poster_path'] : 'app/lib/Style/Images/img-not-found.png';

            $params = array(
                'title' => $data['title'],
                'poster' => $poster,
                'backdrop' => 'https://image.tmdb.org/t/p/original' . $data['backdrop_path'],
                'imdbId' => $data['imdb_id'],
                'tagline' => $data['tagline'],
                'desc' => $overview,
                'time' => $data['runtime'],
                'ano' => substr($data['release_date'], 0, 4),
                'relacionados' => DetalhesModel::relacionados('movie', $id)
            );
        }

        echo $twig->render($template, $params);
    }

    public function serie($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('detalhes-serie.html');

        $data = DetalhesModel::detalhes('tv', $id);

        if (DetalhesModel::isEmpty()) {
            $params = array(
                'title' => 'Página Inexistente'
            );

            $template = $twig->load('error.html');
        } else {
            $overview = strlen($data['overview']) > 230 ? substr($data['overview'], 0, 230) . '...' : $data['overview'];

            $params = array(
                'title' => $data['name'],
                'imdbId' => $data[0],
                'dataEstreia' => substr($data['first_air_date'], 0, 4),
                'dataFim' => substr($data['last_air_date'], 0, 4),
                'temporadas' => $data['number_of_seasons'],
                'poster' => 'https://image.tmdb.org/t/p/original' . $data['poster_path'],
                'backdrop' => 'https://image.tmdb.org/t/p/original' . $data['backdrop_path'],
                'tagline' => $data['tagline'],
                'desc' => $overview,
                'relacionados' => DetalhesModel::relacionados('tv', $id)
            );
        }

        echo $twig->render($template, $params);
    }
}
