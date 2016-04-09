<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\BaseController;
use BackBundle\Form\SchoolType;
use AppBundle\Entity\School;

/**
 * @Route("/schools")
 */
class SchoolsController extends BaseController
{
    /**
     * @Route("/new", name="back_schools_new")
     * @Method({"GET"})
     */
    public function indexAction()
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
}
