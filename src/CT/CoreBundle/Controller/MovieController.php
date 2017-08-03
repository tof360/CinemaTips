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

    public function indexAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie')
        ;

        $listMovies = $repository->findAll();



        return $this->render('CTCoreBundle:Movie:index.html.twig', array(
            'listMovies' => $listMovies
        ) );

    }

    public function movieAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie')
        ;

        // On récupère l'entité correspondante à l'id $id
        $ctMovie = $repository->find($id);


        $genres = $ctMovie->getGenres();
        $crew = $ctMovie->getAuthor();
        $cast = $ctMovie->getCast();
        $movie = array(
            'title' => $ctMovie->getTitle(),
            'id' => $id,
            'content' => $ctMovie->getOverview(),
            'date' => $ctMovie->getReleaseDate(),
            'backdropPath' => $ctMovie->getBackdropPath(),
            'posterPath' => $ctMovie->getPosterPath(),
            'originalTitle' => $ctMovie->getOriginalTitle(),
            'runTime' => $ctMovie->getRuntime(),
            'voteAverage' => $ctMovie->getVoteAverage(),
            'voteCount' => $ctMovie->getVoteCount(),
        );

        return $this->render('CTCoreBundle:Movie:movie.html.twig', array(
            'movie' => $movie,
            'genres' => $genres,
            'cast' => $cast,
            'crew' => $crew,
        ));
    }

    public function viewAction($id)
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie')
        ;

        // On récupère l'entité correspondante à l'id $id
        $ctMovie = $repository->find($id);

        // $ctMovie est donc une instance de OC\PlatformBundle\Entity\Movie
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $ctMovie) {
            $movie = $this->loadMovieRepository($id);
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
            $ctMovie->setVoteAverageCT(8.5);

            // On récupère l'EntityManager
            $em = $this->getDoctrine()->getManager();

            // Étape 1 : On « persiste » l'entité
            $em->persist($ctMovie);

            // Étape 2 : On « flush » tout ce qui a été persisté avant
            $em->flush();
        }



        $genres = $ctMovie->getGenres();
        $crew = $ctMovie->getAuthor();
        $cast = $ctMovie->getCast();
        $movie = array(
            'title' => $ctMovie->getTitle(),
            'id' => $id,
            'content' => $ctMovie->getOverview(),
            'date' => $ctMovie->getReleaseDate(),
            'backdropPath' => $ctMovie->getBackdropPath(),
            'posterPath' => $ctMovie->getPosterPath(),
            'originalTitle' => $ctMovie->getOriginalTitle(),
            'runTime' => $ctMovie->getRuntime(),
            'voteAverage' => $ctMovie->getVoteAverage(),
            'voteCount' => $ctMovie->getVoteCount(),
            'voteAverageCT' => $ctMovie->getVoteAverageCT()
        );

        return $this->render('CTCoreBundle:Movie:view.html.twig', array(
            'movie' => $movie,
            'genres' => $genres,
            'cast' => $cast,
            'crew' => $crew,
        ));
    }


    public function editAction($id, Request $request)
    {


        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('ct_core_view', array('id' => $id));
        }

       $movie = array('id' => $id);

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


