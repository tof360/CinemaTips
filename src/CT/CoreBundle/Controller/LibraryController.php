<?php

namespace CT\CoreBundle\Controller;

use CT\CoreBundle\Entity\Movie;
use CT\CoreBundle\Form\AdvancedSearchType;
use CT\CoreBundle\Form\MovieSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class LibraryController extends Controller
{


    public function loadMovieRepository($id)
    {
        $client = $this->get('tmdb.client');
        $repository = new \Tmdb\Repository\MovieRepository($client);
        $movie = $repository->load($id, array('language' => 'fr', 'append_to_response' => 'credits'));

        return $movie;

    }


    public function addMovieToDB($id){

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


        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($ctMovie);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();
    }


    /**
     * @Security("has_role('ROLE_LIBRARY')")
     */

    public function libraryPanelAction(){


        $currentUser = $this->getUser();
        $movieList = $currentUser->getMovieList();



        return $this->render('CTCoreBundle:Movie:libraryPanel.html.twig', array('movieList' => $movieList));



    }

    /**
     * @Security("has_role('ROLE_LIBRARY')")
     */

    public function addToLibraryListAction($id, Request $request)
    {


        $session = $request->getSession();

        $currentUser = $this->getUser();


        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie');

        // On récupère l'entité correspondante à l'id $id
        $movie = $repository->find($id);

        if ($movie == null) $this->addMovieToDB($id);

        $movie = $repository->find($id);

        $users = $movie->getUsers();
        $voted = false;
        foreach ($users as $user) {
            if ($currentUser == $user) $voted = true;
        }


        if ($voted == true) {

            $session->getFlashBag()->add('info', 'Vous avez déjà ce film dans votre liste!');

            return $this->redirectToRoute('ct_core_librarypanel');
        } else {

            $currentUser->addMovieList($movie);
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();

            $session->getFlashBag()->add('info', 'Le film a bien été ajouté à votre liste');

            return $this->redirectToRoute('ct_core_librarypanel');
        }
    }


    /**
     * @Security("has_role('ROLE_LIBRARY')")
     */
    public function removeFromLibraryListAction($id, Request $request)
    {

        $session = $request->getSession();

        $user = $this->getUser();

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie');

        // On récupère l'entité correspondante à l'id $id
        $movie = $repository->find($id);

        $user->removeMovieList($movie);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $session->getFlashBag()->add('info', 'Le film a bien été retiré de votre liste');

        return $this->redirectToRoute('ct_core_librarypanel');
    }


}