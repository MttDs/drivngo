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
use AppBundle\Entity\Pricing;
use BackBundle\Form\PricingType;

/**
 * @Route("/schools/{school_id}", requirements={"school_id" = "\d+"})
 */
class PricingsController extends BaseController
{
    /**
     * @Route("/pricings", name="back_schools_pricings")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function indexAction(Request $request, School $school) {
        $form = $this->createForm(PricingType::class, new Pricing());

        return $this->render('BackBundle:Pricings:index.html.twig', array(
                'school' => $school,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/pricings/create", name="back_schools_pricings_new")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"GET"})
     */
    public function newAction(Request $request, School $school) {
        $form = $this->createForm(PricingType::class, new Pricing());

        return $this->render('BackBundle:Pricings:new.html.twig', array(
                'school' => $school,
                'form' => $form->createView()
            )
        );
    }
    /**
     * @Route("/pricings/create", name="back_schools_pricings_create")
     * @Security("has_role('ROLE_MANAGER')")
     * @ParamConverter("school_manager")
     * @Method({"POST"})
     */
    public function createAction(Request $request, School $school) {
        $pricing = new Pricing();
        $pricing->setSchool($school);
        $pricing->setActive(true);
        $form = $this->createForm(PricingType::class, $pricing);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pricing);

            $em->flush();

            $this->setFlash('notice', 'Nouveau tarif ajouté');
            return $this->redirect($this->generateUrl('back_schools_pricings', array('school_id' => $school->getId())));
        }

        $this->setFlash('alert', "Impossible d'ajouter ce tarif");

        return $this->render('BackBundle:Pricings:new.html.twig', array(
                'school' => $school,
                'form' => $form->createView()
            )
        );
    }
}
