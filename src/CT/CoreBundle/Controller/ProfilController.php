<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 26-07-17
 * Time: 09:09
 */

namespace CT\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    public function viewAction($id)
    {
        $content = $this->get('templating')->render('CTCoreBundle:Profil:index.html.twig');

        return new Response($content);

    }
}