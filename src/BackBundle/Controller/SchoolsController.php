<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use BackBundle\Form\SchoolType;
use AppBundle\Entity\School;

class SchoolsController extends Controller
{
    /**
     * @Route("/schools/new")
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
}
