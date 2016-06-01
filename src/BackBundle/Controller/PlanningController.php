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
use UserBundle\Entity\User;


class PlanningController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/planning", name="back_schools_plannings", requirements={"school_id" = "\d+"})
     * @Security("is_granted('ROLE_USER')")
     * @ParamConverter("in_school")
     * @Method({"GET"})
     */
    public function indexAction(School $school)
    {
       $user = $this->getUser();

        if ($user->hasRole('ROLE_INSTRUCTOR')) {
            $employeeRepo = $this->getRepository('BackBundle:Employee');
        }
        else {
            $studentRepo = $this->getRepository('BackBundle:Student');
        }
         return $this->render('BackBundle:Plannings:index.html.twig', array('school' => $school));
    }

}
