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
use UserBundle\Entity\User;
use BackBundle\Entity\Employees;
use BackBundle\Form\EmployeeType;

class EmployeesController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/employees", name="back_schools_employees", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function indexAction(School $school)
    {
        return $this->render('BackBundle:Employees:index.html.twig', array('school' => $school));
    }

    /**
     * @Route("/schools/{school_id}/employees/new", name="back_schools_employees_new", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function newAction(School $school)
    {
        $form = $this->createForm(EmployeeType::class, new User());

        return $this->render('BackBundle:Employees:new.html.twig', array(
            'school' => $school,
            'form'   => $form->createView()));
    }
}
