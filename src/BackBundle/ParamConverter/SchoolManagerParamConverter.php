<?php

namespace BackBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManager;

class SchoolManagerParamConverter implements ParamConverterInterface
{

    protected $securityContext;
    protected $entityManager;

    public function __construct(SecurityContext $securityContext, EntityManager $entityManager)
    {
        $this->securityContext = $securityContext;
        $this->entityManager = $entityManager;
    }

    public function supports(ParamConverter $configuration)
    {
        if ('school_manager' !== $configuration->getName()) {
            return false;
        }

        return true;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $schoolRepo = $this->entityManager->getRepository('AppBundle:School');
        $user = $this->securityContext->getToken()->getUser();

        $id = null;

        if (!is_null($request->get('id'))) {
            $id = $request->get('id');
        }
        else if (!is_null($request->get('school_id'))) {
            $id = $request->get('school_id');
        }

        $params = array(
            'id'     => $id,
            'userId' => $user->getId()
        );

        $school = $schoolRepo->findSchoolFromManager($params);

        if ($school !== null) {
            $request->attributes->set('school', $school);

            return true;
        }

        throw new AccessDeniedException();
    }
}
