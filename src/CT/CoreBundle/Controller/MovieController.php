<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 27-07-17
 * Time: 18:58
 */

namespace CT\CoreBundle\Controller;

use CT\CoreBundle\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class MovieController extends Controller
{

    public function loadMovieRepository($id)
    {
        $client = $this->get('tmdb.client');
        $repository = new \Tmdb\Repository\MovieRepository($client);
        $movie      = $repository->load($id, array('language' => 'fr', 'append_to_response' => 'credits'));

        return $movie;

    }

    public function viewAction($id)
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

        return $this->render('CTCoreBundle:Movie:view.html.twig', array(
            'movie' => $movie,
            'genres' => $genres,
            'cast' => $cast,
            'crew' => $crew,
        ));
    }

    public function addAction($id)
    {
        $movie = $this->loadMovieFromTMDB($id);
        $ctMovie = new Movie();
        $ctMovie->setId($id);
        $ctMovie->setVoteAverage($movie->getVoteAverage());
        $ctMovie->setRunTime($movie->getRuntime());
        $ctMovie->setTitle($movie->getTitle());
        $ctMovie->setBackdropPath($movie->getBackdropPath());
        $ctMovie->setGenres($movie->getGenres());
        $ctMovie->setAuthor($movie->getCredits()->getCrew());
        $ctMovie->setCast($movie->getCredits()->getCast());
        $ctMovie->setOriginalLanguage($movie->getOriginalLanguage());
        $ctMovie->setVoteCount($movie->getVoteCount());
        $ctMovie->setReleaseDate($movie->getReleaseDate());
        $ctMovie->setPosterPath($movie->getPosterPath());
        $ctMovie->setOverview($movie->getOverview());
        $ctMovie->setOriginalTitle($movie->getOriginalTitle());

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($ctMovie);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();

        return $this->redirectToRoute('ct_core_view', array('id' => $ctMovie->getId()));
    }

    public function editAction($id, Request $request)
    {


        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('ct_core_view', array('id' => $id));
        }

        $movie = $this->loadMovieFromTMDB($id);

        $movie = array(
            'title'   => $movie->getTitle(),
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => $movie->getOverview(),
            'date'    => $movie->getReleaseDate()
        );

        return $this->render('CTCoreBundle:Movie:edit.html.twig', array(
            'movie' => $movie
        ));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('CTCOreBundle:Movie:delete.html.twig');
    }
}


