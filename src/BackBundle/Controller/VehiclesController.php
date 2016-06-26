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
}
