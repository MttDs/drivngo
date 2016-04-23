<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use BackBundle\Entity\Student;
use AppBundle\Entity\Payment;
use AppBundle\Entity\Pricing;
use AppBundle\Entity\School;
use AppBundle\Form\PaymentType;

class PaymentsController extends BaseController
{
    /**
     * @Route("/schools/{school_id}/payment/create", name="front_schools_payments_create")
     * @ParamConverter("school", class="AppBundle:School", options={"mapping": {"school_id": "id"}})
     * @Security("has_role('ROLE_USER')")
     * @Method({"POST"})
     */
    public function createAction(Request $request, School $school)
    {
        $payment = new Payment();
        $payment->setUser($this->getUser());
        $payment->setSchool($school);
        $paymentForm = $this->createForm(PaymentType::class, $payment, array('school_id' => $school->getId()));

        $paymentForm->handleRequest($request);

        if ($paymentForm->isSubmitted() && $paymentForm->isValid()) {
            $payment->setPrice($payment->getPricing()->getPrice());
            $payment->setCreatedAt(new \DateTime());
            $payment->setUpdatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            if (!is_null($payment->getId())) {
                $student = new Student();
                $student->setSchool($school);
                $student->setUser($this->getUser());
                $student->setActive(false);

                $em->persist($student);
                $em->flush();

                $this->setFlash('notice', "Transaction effecutée. Elle sera validée prochainement par l'auto-école");

                return $this->redirect($this->generateUrl('front_schools_show', array('id' => $school->getId())));
            }
        }

        $this->setFlash('alert', "Impossible de valider votre inscription");

        return $this->render('AppBundle:Schools:show.html.twig', array(
                'school' => $school,
                'paymentForm' => $paymentForm->createView()
            )
        );
    }
}
