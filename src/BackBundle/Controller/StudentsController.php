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

class StudentsController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/students", name="back_schools_students", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("works_in")
     * @Method({"GET"})
     */
    public function indexAction(Request $request, School $school)
    {
        return $this->render('BackBundle:Students:index.html.twig', array(
                'school' => $school
            )
        );
    }

    /**
     * @Route("/schools/{school_id}/students/{id}", name="back_schools_students_change", requirements={"school_id" = "\d+", "id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("works_in")
     * @ParamConverter("employee", class="BackBundle:Student", options={"id" = "id"})
     * @Method({"POST"})
     */
    public function changeAction(Request $request, School $school, Student $employee)
    {
        $em = $this->getDoctrine()->getManager();

        if (null !== $request->request->get('active') && $request->request->get('active') == "on"){
            $this->setFlash('notice', "L'utilisateur ".$employee->getUser()->getFirstname()." ".$employee->getUser()->getLastname() ." a été activé.");

            $employee->setActive(true);
        }
        else {
            $this->setFlash('notice', "L'utilisateur ".$employee->getUser()->getFirstname()." ".$employee->getUser()->getLastname() ." a été désactivé.");

            $employee->setActive(false);
        }

        $em->persist($employee);
        $em->flush();

        return $this->redirect($this->generateUrl('back_schools_students', array('school_id' => $school->getId())));
    }
}
