<?php

namespace BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\BaseController;

class DashboardController extends BaseController
{
    /**
     * @Route("/", name="back_dashboard_home")
     * @Method({"GET"})
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


    /**
     * @Route("/update_charts", name="back_dashboard_update_charts")
     * @Method({"GET"})
     */
    public function updateChartAction()
    {
        $schoolRepo = $this->getRepository('AppBundle:School');
        $paymentRepo = $this->getRepository('AppBundle:Payment');

        $schools = $schoolRepo->findBy(array(
                'user' => $this->getUser()
            )
        );

        $days = array();

        foreach ($schools as $school) {
            $days[$school->getId()] = $paymentRepo->getTurnoverBySchoolBetweenDate($school->getId(), null, null);
        }

        return new JsonResponse($days);
    }
}
