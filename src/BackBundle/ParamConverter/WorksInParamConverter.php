<?php

namespace BackBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManager;

class WorksInParamConverter implements ParamConverterInterface
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
        if ('works_in' !== $configuration->getName()) {
            return false;
        }

        return true;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $schoolRepo = $this->entityManager->getRepository('AppBundle:School');
        $user = $this->securityContext->getToken()->getUser();

        $id = null;

        if (is_null($request->get('school_id'))) {
            throw new AccessDeniedException();
        }

        $school = $schoolRepo->find($request->get('school_id'));

        foreach ($user->getEmployees() as $employee) {
            if ($employee->getSchool() == $school && $employee->getActive() == true) {
                $request->attributes->set('school', $school);

                return;
            }
        }

        throw new AccessDeniedException();
    }
}
