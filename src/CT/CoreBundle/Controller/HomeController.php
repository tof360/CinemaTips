<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 26-07-17
 * Time: 09:45
 */

namespace CT\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('CTCoreBundle:Home:index.html.twig', array('listMovies' => array()));

    }

    public function loadMovieRepository($id)
    {
        $client = $this->get('tmdb.client');
        $repository = new \Tmdb\Repository\MovieRepository($client);
        $movie      = $repository->load($id, array('language' => 'fr', 'append_to_response' => 'credits'));

        return $movie;

    }

    public function movieAction($id)
    {
        $movie = $this->loadMovieRepository($id);



        /**
         * $listPerson [] = $movie->getCredits()->getCrew();

        $genres[] = array();
        foreach ($movie->getGenres() as $genre) {
        $genres [] = array('name' => $genre->getName());
        }
         *
         **/

        $genres = $movie->getGenres();
        $crew = $movie->getCredits()->getCrew();
        $cast = $movie->getCredits()->getCast();
        $movie = array(
            'title' => $movie->getTitle(),
            'id' => $id,
            'content' => $movie->getOverview(),
            'date' => $movie->getReleaseDate(),
            'backdropPath' => $movie->getBackdropPath(),
            'posterPath' => $movie->getPosterPath(),
            'originalTitle' => $movie->getOriginalTitle(),
            'runTime' => $movie->getRuntime(),
            'voteAverage' => $movie->getVoteAverage(),
            'voteCount' => $movie->getVoteCount(),
        );

        return $this->render('CTCoreBundle:Movie:movie.html.twig', array(
            'movie' => $movie,
            'genres' => $genres,
            'cast' => $cast,
            'crew' => $crew,
        ));
    }

}