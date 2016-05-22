<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\BaseController;
use BackBundle\Form\SchoolType;
use AppBundle\Entity\School;
use BackBundle\Entity\Employee;

/**
 * @Route("/schools")
 */
class SchoolsController extends BaseController
{
    /**
     * @Route("/new", name="back_schools_new")
     * @Method({"GET"})
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function newAction()
    {
        $school = new School();
        $form = $this->createForm(SchoolType::class, $school);

        return $this->render('BackBundle:Schools:new.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/create", name="back_schools_create")
     * @Security("has_role('ROLE_MANAGER')")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $school = new School();
        $school->setUser($this->getUser());
        $form = $this->createForm(SchoolType::class, $school);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($school);

            $employee = new Employee();
            $employee->setSchool($school);
            $employee->setUser($this->getUser());
            $employee->setActive(true);
            $em->persist($employee);

            $em->flush();

            $this->setFlash('notice', 'Auto école créée !');

            return $this->redirect(
                $this->generateUrl('back_schools_show', array(
                        'id' => $school->getId()
                    )
                )
            );
        }

        $this->setFlash('alert', 'Impossible de créer cette auto école');

        return $this->render('BackBundle:Schools:new.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="back_schools_show")
     * @ParamConverter("school", class="AppBundle:School", options={"id" = "id"})
     * @Method({"GET"})
     */
    public function showAction(Request $request, School $school)
    {
        $ads = array();

        foreach ($school->getAds() as $ad) {
            $ads[$ad->getAdType()->getName()] = $ad;
        }

        return $this->render('BackBundle:Schools:show.html.twig', array(
                'school'      => $school,
                'ads'         => $ads
            )
        );

    }

    /**
     * @Route("/{id}/edit", requirements={"id" = "\d+"}, name="back_schools_edit")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function editAction(School $school)
    {
        $form = $this->createForm(SchoolType::class, $school, array(
                'method' => 'PUT'
            )
        );

        return $this->render('BackBundle:Schools:edit.html.twig', array(
                'school' => $school,
                'form'   => $form->createView()
            )
        );
    }

    /**
     * @Route("/{id}/update", requirements={"id" = "\d+"}, name="back_schools_update")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, School $school)
    {
        $form = $this->createForm(SchoolType::class, $school, array(
                'method' => 'PUT'
            )
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($school);
            $em->flush();

            $this->setFlash('notice', 'Auto école modifiée !');

            return $this->redirect(
                $this->generateUrl('back_schools_show', array(
                        'id' => $school->getId()
                    )
                )
            );
        }

        $this->setFlash('alert', 'Impossible de modifier cette auto école');

        return $this->render('BackBundle:Schools:edit.html.twig', array(
                'school' => $school,
                'form'   => $form->createView()
            )
        );
    }

    /**
     * @Route("/{id}/destroy", requirements={"id" = "\d+"}, name="back_schools_destroy")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET", "DELETE"})
     */
    public function destroyAction(Request $request, School $school) {
        $token = $request->request->get('school')['_token'];
        $csrf = $this->get('form.csrf_provider');

        if ($request->isMethod('GET')) {
            $destroyForm = $this->createForm(SchoolType::class, $school, array(
                    'method' => 'DELETE'
                )
            );

            return $this->render('BackBundle:Schools:delete.html.twig', array(
                    'school'      => $school,
                    'destroyForm' => $destroyForm->createView()
                )
            );
        }

        if ($csrf->isCsrfTokenValid('school_type', $token)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($school);
            $em->flush();

            $this->setFlash('notice', 'Auto école supprimée');

            return $this->redirect($this->generateUrl('back_dashboard_home'));
        }

        $this->setFlash('alert', 'Impossible de supprimer cette auto école');

        return $this->redirect(
            $this->generateUrl('back_schools_show', array(
                    'id' => $school->getId()
                )
            )
        );
    }

    /**
     * @Route("/{id}/update_chart", requirements={"id" = "\d+"}, name="back_schools_update_chart")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function updateChartAction(Request $request, School $school) {
        $paymentRepo = $this->getRepository('AppBundle:Payment');

        $dateMin = null;
        $dateMax = null;

        if (!is_null($request->get('dateMin')))
            $dateMin = new \DateTime($request->get('dateMin'));

        if (!is_null($request->get('dateMax')))
            $dateMax = new \DateTime($request->get('dateMax'));

        $days = $paymentRepo->getTurnoverBySchoolBetweenDate($school->getId(), $dateMin, $dateMax);

        return new JsonResponse($days);
    }

}
