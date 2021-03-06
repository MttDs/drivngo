<?php

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EmployeeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmployeeRepository extends EntityRepository
{
    public function findBySchoolAndRole($school, $role)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
            ->from($this->_entityName, 'e')
            ->join('e.user', 'u')
            ->where('e.school = :school and e.active = true')
            ->andWhere('u.roles LIKE :role')
            ->setParameter('school', $school)
            ->setParameter('role', '%"'.$role.'"%');

        return $qb->getQuery()->getResult();
    }
}
