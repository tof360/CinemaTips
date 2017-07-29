<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 27-07-17
 * Time: 18:58
 */

namespace CT\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{

    public function loadMovieFromTMDB($id)
    {
        $client = $this->get('tmdb.client');
        $repository = new \Tmdb\Repository\MovieRepository($client);
        $movie      = $repository->load($id);

        return $movie;

    }

    public function viewAction($id)
    {
        $movie = $this->loadMovieFromTMDB($id);

        $film = array(
            'title'   => $movie->getTitle(),
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => $movie->getOverview(),
            'date'    => $movie->getReleaseDate()
        );

        return $this->render('CTCoreBundle:Film:view.html.twig', array(
            'film' => $film
        ));
    }

    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('ct_core_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('CTCoreBundle:Film:add.html.twig');
    }

    public function editAction($id, Request $request)
    {


        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('ct_core_view', array('id' => $id));
        }

        $movie = $this->loadMovieFromTMDB($id);

        $film = array(
            'title'   => $movie->getTitle(),
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => $movie->getOverview(),
            'date'    => $movie->getReleaseDate()
        );

        return $this->render('CTCoreBundle:Film:edit.html.twig', array(
            'film' => $film
        ));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('CTCOreBundle:Film:delete.html.twig');
    }
}


