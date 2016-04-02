<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard")
     */
    public function indexAction()
    {
        return $this->render('BackBundle:Dashboard:index.html.twig');
    }
}