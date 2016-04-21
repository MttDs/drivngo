<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SchoolsController extends BaseController
{
    /**
     * @Route("/auto-ecoles")
     */
    public function indexAction(Request $request)
    {
        $schoolsRepository = $this->getRepository('AppBundle:School');
        $query = $schoolsRepository->getSchoolsQuery();

        $pagination = $this->getPaginator()->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('AppBundle:Schools:index.html.twig', array(
                'schools' => $pagination
            )
        );
    }
}
