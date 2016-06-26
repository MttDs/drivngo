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
use AppBundle\Entity\Vehicle;
use BackBundle\Form\VehicleType;

class VehiclesController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/vehicles", name="back_schools_vehicles", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("works_in")
     * @Method({"GET"})
     */
    public function indexAction(School $school)
    {
        return $this->render('BackBundle:Vehicles:index.html.twig', array('school'      => $school));
    }

    /**
     * @Route("/schools/{school_id}/vehicles/new", name="back_schools_vehicles_new", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("works_in")
     * @Method({"GET"})
     */
    public function newAction(School $school)
    {
        $form = $this->createForm(VehicleType::class, new Vehicle());

        return $this->render('BackBundle:Vehicles:new.html.twig', array(
            'school' => $school,
            'form'   => $form->createView()));
    }

    /**
     * @Route("/schools/{school_id}/vehicles/create", name="back_schools_vehicles_create", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_SECRETARY')")
     * @ParamConverter("works_in")
     * @Method({"POST"})
     */
    public function createAction(Request $request, School $school)
    {
        $vehicle = new Vehicle();
        $vehicle->setSchool($school);

        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($request);
        $vehicle->setLastCheck(new \DateTime($vehicle->getLastCheck()));

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($vehicle);
            $em->flush();
            $this->setFlash('notice', "Véhicule créé avec succès !");
            return $this->redirect($this->generateUrl('back_schools_vehicles', array('school_id' => $school->getId())));
        }

        $this->setFlash('alert', "Impossible de créer ce véhicule");

        return $this->render('BackBundle:Vehicles:new.html.twig', array('school' => $school, 'form' => $form->createView()));
    }

}
