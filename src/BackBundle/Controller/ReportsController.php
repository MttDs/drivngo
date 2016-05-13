<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\BaseController;
use BackBundle\Form\ReportType;
use AppBundle\Entity\School;
use BackBundle\Entity\Student;
use BackBundle\Entity\Report;
use UserBundle\Entity\User;

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

    /**
     * @Route("/schools/{school_id}/reports/{user_id}/new", name="back_schools_reports_new", requirements={"school_id" = "\d+"})
     * @Security("is_granted('ROLE_USER')")
     * @ParamConverter("user", class="UserBundle:User", options={"id" = "user_id"})
     * @ParamConverter("in_school")
     * @Method({"GET"})
     */
    public function newAction(Request $request, School $school, User $user)
    {
        $form = $this->createForm(ReportType::class, new Report());

        return $this->render('BackBundle:Reports:new.html.twig', array(
                'school' => $school,
                'user' => $user,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/schools/{school_id}/reports/{user_id}/create", name="back_schools_reports_create", requirements={"school_id" = "\d+"})
     * @Security("is_granted('ROLE_USER')")
     * @ParamConverter("user", class="UserBundle:User", options={"id" = "user_id"})
     * @ParamConverter("in_school")
     * @Method({"POST"})
     */
    public function createAction(Request $request, School $school, User $user)
    {
        $report = new Report();
        $report->setUser($user);
        $report->setVoter($this->getUser());
        $report->setSchool($school);
        $report->setCreatedAt(new \DateTime());

        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            $this->setFlash('notice', "Note ajoutée !");

            return $this->redirect($this->generateUrl('back_schools_reports', array('school_id' => $school->getId())));
        }

        $this->setFlash('alert', "Impossible d'ajouter cette note");

        return $this->render('BackBundle:Reports:new.html.twig', array(
                'school' => $school,
                'user' => $user,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/schools/{school_id}/reports/show", name="back_schools_reports_show", requirements={"school_id" = "\d+"})
     * @Security("is_granted('ROLE_USER')")
     * @ParamConverter("in_school")
     * @Method({"GET"})
     */
    public function showAction(Request $request, School $school)
    {
        $reportRepo = $this->getRepository('BackBundle:Report');
        $reports = $reportRepo->findBySchoolAndUser($school, $this->getUser());

        $note = 0;

        foreach ($reports as $report) {
            $note += $report->getRating();
        }

        if (0 != $note) {
            $note = round($note/count($reports), 2);
        }

        return $this->render('BackBundle:Reports:show.html.twig', array(
                'school'    => $school,
                'note'      => $note,
                'reports'   => $reports,
            )
        );
    }
}
