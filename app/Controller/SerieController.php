<?php

namespace app\Controller;

use app\Model\SerieModel;

class SerieController extends ErroController
{
    public function detalhes($serieId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('detalhes-serie.html');

        $serie = SerieModel::detalhesDaSerie($serieId);

        if (!is_array($serie) || SerieModel::getError()) {
            $params = array(
                'title' => 'Página Inexistente'
            );

            $template = $twig->load('error.html');
        } else {
            $overview = strlen($serie['overview']) > 230 ? substr($serie['overview'], 0, 230) . '...' : $serie['overview'];
            
            $params = array(
                'title' => $serie['name'],
                'imdbId' => $serie[0],
                'data-estreia' => $serie['first_air_date'],
                'data-fim' => $serie['last_air_date'],
                'poster' => 'https://image.tmdb.org/t/p/original' . $serie['poster_path'],
                'backdrop' => 'https://image.tmdb.org/t/p/original' . $serie['backdrop_path'],
                'tagline' => $serie['tagline'],
                'desc' => $overview,
                'relacionados' => SerieModel::SeriesRelacionadas($serieId)
            );
        }

        echo $twig->render($template, $params);
    }
}
