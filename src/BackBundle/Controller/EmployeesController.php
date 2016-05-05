<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\School;
use UserBundle\Entity\User;
use BackBundle\Entity\Employee;
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

     /**
     * @Route("/schools/{school_id}/employees/create", name="back_schools_employees_create", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"POST"})
     */
    public function createAction(Request $request, School $school) {
        $user = new User();

        $form = $this->createForm(EmployeeType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setEnabled(true);

            $em->persist($user);
            $em->flush();

            $employee = new Employee();

            $employee->setSchool($school);
            $employee->setUser($user);
            $employee->setActive(true);

            $em->persist($employee);
            $em->flush();


            $this->setFlash('notice', "Employé crée !");
            return $this->redirect($this->generateUrl('back_schools_employees', array('school_id' => $school->getId())));
        }

        $this->setFlash('alert', "Impossible de créer cet employé");

        return $this->render('BackBundle:Employees:new.html.twig', array('school' => $school));
    }

    /**
     * @Route("/schools/{school_id}/employees/{user_id}/edit", name="back_schools_employees_edit", requirements={"school_id" = "\d+", "user_id" = "\d+"})
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @ParamConverter("user", class="UserBundle:User", options={"id" = "user_id"})
     * @Method({"GET"})
     */
    public function editAction(School $school, User $user)
    {
        if (!$user->worksIn($school)) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(EmployeeType::class, $user);

        return $this->render('BackBundle:Employees:edit.html.twig', array(
            'school' => $school,
            'form'   => $form->createView()));
    }
}
