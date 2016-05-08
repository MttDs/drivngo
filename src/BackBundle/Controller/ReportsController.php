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
use BackBundle\Entity\Student;

class ReportsController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/reports", name="back_schools_reports", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_USER', 'ROLE_INSCRUCTOR')")
     * @ParamConverter("in_school")
     * @Method({"GET"})
     */
    public function indexAction(Request $request, School $school)
    {
        return $this->render('BackBundle:Reports:index.html.twig', array(
                'school' => $school
            )
        );
    }
}
