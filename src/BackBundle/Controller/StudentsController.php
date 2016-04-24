<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\School;

class StudentsController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/students", name="back_schools_students", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("works_in")
     * @Method({"GET"})
     */
    public function indexAction(Request $request, School $school) {
        return $this->render('BackBundle:Students:index.html.twig', array(
                'school' => $school
            )
        );
    }
}
