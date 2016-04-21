<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\School;

class SchoolsController extends BaseController
{
    /**
     * @Route("/auto-ecoles", name="front_schools")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $schoolsRepository = $this->getRepository('AppBundle:School');
        $query = $schoolsRepository->getSchoolsQuery();

        $pagination = $this->getPaginator()->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('AppBundle:Schools:index.html.twig', array(
                'schools' => $pagination
            )
        );
    }

    /**
     * @Route("/auto-ecoles/{id}", requirements={"id" = "\d+"}, name="front_schools_show")
     * @ParamConverter("school", class="AppBundle:School", options={"id" = "id"})
     * @Method({"GET"})
     */
    public function showAction(School $school) {
        return $this->render('AppBundle:Schools:show.html.twig', array(
                'school' => $school
            )
        );
    }
}
