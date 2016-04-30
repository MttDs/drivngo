<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\BaseController;
use BackBundle\Form\SchoolType;
use AppBundle\Entity\School;
use BackBundle\Entity\Employee;

/**
 * @Route("/schools")
 */
class AdsController extends BaseController
{

    /**
     * @Route("/ads", name="back_schools_ads")
     * @Method({"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function indexAction() {
        $schoolRepo = $this->getRepository('AppBundle:School');
        $schools = $schoolRepo->findAll();

        return $this->render('BackBundle:Ads:index.html.twig', array(
                'schools' => $schools
            )
        );
    }
}
