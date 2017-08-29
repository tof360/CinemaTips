<?php

namespace CT\CoreBundle\Controller;

use CT\CoreBundle\Entity\Movie;
use CT\CoreBundle\Form\AdvancedSearchType;
use CT\CoreBundle\Form\MovieSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CT\CoreBundle\Form\MovieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class LibraryController extends Controller
{

    public function libraryPanelAction(){





    }

    public function addToLibraryListAction($id){


       // $session = $request->getSession();

        $user = $this->getUser();


        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('CTCoreBundle:Movie');

        // On récupère l'entité correspondante à l'id $id
        $movie = $repository->find($id);

        $user->addMovieList($movie);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();


        // removeMovieList(\CT\CoreBundle\Entity\Movie $movieList


        return $this->redirectToRoute('ct_core_home');


    }
}