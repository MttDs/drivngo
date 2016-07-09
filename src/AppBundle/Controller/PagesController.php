<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PagesController extends Controller
{
    /**
     * @Route("/", name="front_home")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Pages:index.html.twig');
    }

    /**
     * @Route("/nos-partenaires", name="front_partners")
     */
    public function partnersAction()
    {
        return $this->render('AppBundle:Pages:partners.html.twig');
    }

    /**
     * @Route("/nous-contacter", name="front_contact")
     */
    public function contactAction()
    {
        return $this->render('AppBundle:Pages:contact.html.twig');
    }
}
