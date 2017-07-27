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
        $content = $this->get('templating')->render('CTCoreBundle:Home:index.html.twig');


        return new Response($content);

    }

}