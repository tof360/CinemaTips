<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 27-07-17
 * Time: 18:58
 */

namespace CT\CoreBundle\Controller;

use CT\CoreBundle\Entity\Movie;
use CT\CoreBundle\Form\AdvancedSearchType;
use CT\CoreBundle\Form\MovieSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CT\CoreBundle\Form\MovieType;


class MovieController extends Controller
{

    public function loadMovieRepository($id)
    {
        $client = $this->get('tmdb.client');
        $repository = new \Tmdb\Repository\MovieRepository($client);
        $movie      = $repository->load($id, array('language' => 'fr', 'append_to_response' => 'credits'));

        return $movie;

    }

    public function searchMovieAction(Request $request)
    {

        $formSearch = $this->get('form.factory')->create(MovieSearchType::class);

        $listMovies = null;

        if ($request->isMethod('POST') && $formSearch->handleRequest($request)->isValid()) {

            $data = $formSearch->getData();

            $client = $this->get('tmdb.client');

            $listMovies = $client->getSearchApi()->searchMovies($data['title']);

            return $this->render('CTCoreBundle:Movie:listMovies.html.twig', array(
                'listMovies' => $listMovies,
                'formSearch' => $formSearch->createView()

            ));
        }

        return $this->render('CTCoreBundle:Movie:searchForm.html.twig', array(
            'formSearch' => $formSearch->createView(),
            'listMovies' => $listMovies,

        ));

    }

    public function advancedSearchAction(Request $request)
    {
        $form = $this->get('form.factory')->create(AdvancedSearchType::class);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CTCoreBundle:Movie')
            ;

            $data = $form->getData();

            $listMovies = $repository->findMovieByParameters($data);

            return $this->render('CTCoreBundle:Movie:advancedList.html.twig', array(
                'listMovies' => $listMovies,
                'data' => $data
            ));




        }

        return $this->render('CTCoreBundle:Movie:advancedSearch.html.twig', array('form' => $form->createView()));
    }

    public function indexAction()
    {

        $listMovies = null;

        return $this->render('CTCoreBundle:Movie:index.html.twig', array( 'searchListMovies' => $listMovies));

    }


    public function movieAction($id)
    {
        $ctMovie = $this->loadMovieRepository($id);

        // On récupère l'entité correspondante à l'id $id



        $genres = $ctMovie->getGenres();
        $crew = $ctMovie->getCredits()->getCrew();
        $cast = $ctMovie->getCredits()->getCast();
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
            'voteAverageCT' => $ctMovie->getVoteAverageCT(),
            'violence' => $ctMovie->getViolence(),
            'complexity' => $ctMovie->getComplexity(),
            'twist' => $ctMovie->getTwist(),
            'emotion' => $ctMovie->getEmotion(),
            'specialEffects' => $ctMovie->getSpecialEffects(),
            'originality' => $ctMovie->getOriginality(),
            'voteCountCT' => $ctMovie->getVoteCountCT()
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



        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie')
        ;

        // On récupère l'entité correspondante à l'id $id
        $ctMovie = $repository->find($id);

        $form   = $this->get('form.factory')->create(MovieType::class, $ctMovie);


        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $ctMovie->setVoteCountCT();
                $em = $this->getDoctrine()->getManager();
                $em->persist($ctMovie);
                $em->flush();

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->redirectToRoute('ct_core_view', array('id' => $id));
            }
        }

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('CTCoreBundle:Movie:edit.html.twig', array(
            'form' => $form->createView(),
            'movie' => $ctMovie
        ));
    }

}


