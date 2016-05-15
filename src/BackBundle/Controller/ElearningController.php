<?php

namespace BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\School;

class ElearningController extends BaseController
{

    /**
     * @Route("/schools/{school_id}/elearning", name="back_elearning", requirements={"school_id" = "\d+"})
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET"})
     * @ParamConverter("in_school")
     */
    public function indexAction(School $school) {
        $studentRepo = $this->getRepository('BackBundle:Student');
        $student = $studentRepo->findOneBy(
            array(
                'school'    => $school,
                'user'      => $this->getUser(),
                'active'    => true,
                'eLearning' => true
            )
        );

        if ($student != null)
            return $this->render('BackBundle:Elearning:index.html.twig', array('school' => $school));

        throw new AccessDeniedException();
    }
}
