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
     * @Security("is_granted('ROLE_USER')")
     * @ParamConverter("in_school")
     * @Method({"GET"})
     */
    public function indexAction(Request $request, School $school)
    {
        $user = $this->getUser();

        if ($user->hasRole('ROLE_INSTRUCTOR')) {
            $studentRepo = $this->getRepository('BackBundle:Student');

            $persons = $studentRepo->findBySchool($school);
        }
        else {
            $employeeRepo = $this->getRepository('BackBundle:Employee');

            $persons = $employeeRepo->findBySchoolAndRole($school, 'ROLE_INSTRUCTOR');
        }

        return $this->render('BackBundle:Reports:index.html.twig', array(
                'school' => $school,
                'persons' => $persons
            )
        );
    }
}
