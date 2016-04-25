<?php

namespace BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\BaseController;

class DashboardController extends BaseController
{
    /**
     * @Route("/", name="back_dashboard_home")
     */
    public function indexAction()
    {
        $schoolRepo = $this->getRepository('AppBundle:School');
        $schools = $schoolRepo->findBy(array(
                'user' => $this->getUser()
            )
        );


        return $this->render('BackBundle:Dashboard:index.html.twig', array('schools' => $schools));
    }
}
