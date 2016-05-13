<?php

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ReportRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReportRepository extends EntityRepository
{
    public function findBySchoolAndUser($school, $user)
    {
        $qb = $this->_em->createQueryBuilder()
           ->select('r')
           ->from($this->_entityName, 'r')
           ->join('r.user', 'u')
           ->where('r.user = :u and r.school = :s')
           ->setParameter('u', $user)
           ->setParameter('s', $school);

        return $qb->getQuery()->getResult();
    }
}
