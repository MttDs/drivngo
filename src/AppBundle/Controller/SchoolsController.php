<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SchoolsController extends Controller
{
    /**
     * @Route("/auto-ecoles")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Schools:index.html.twig');
    }
}
