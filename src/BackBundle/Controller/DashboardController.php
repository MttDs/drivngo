<?php

namespace BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
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
    public function updateChartAction(Request $request)
    {
        $schoolRepo = $this->getRepository('AppBundle:School');
        $paymentRepo = $this->getRepository('AppBundle:Payment');

        $schools = $schoolRepo->findBy(array(
                'user' => $this->getUser()
            )
        );

        $dateMin = null;
        $dateMax = null;

        if (!is_null($request->get('dateMin')))
            $dateMin = new \DateTime($request->get('dateMin'));

        if (!is_null($request->get('dateMax')))
            $dateMax = new \DateTime($request->get('dateMax'));

        $days = array();

        foreach ($schools as $school) {
            $days[$school->getId()] = $paymentRepo->getTurnoverBySchoolBetweenDate($school->getId(), $dateMin, $dateMax);
        }

        return new JsonResponse($days);
    }
}
