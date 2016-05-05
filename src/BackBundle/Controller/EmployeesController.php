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
use BackBundle\Entity\Employees;

class EmployeesController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/employee", name="back_schools_employees", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function indexAction(School $school) {
        return $this->render('BackBundle:Employees:index.html.twig', array('school' => $school));
    }
}
