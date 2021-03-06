<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\DateFunction;
use AppBundle\Entity\School;

/**
 * PaymentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PaymentRepository extends EntityRepository
{
    public function getTurnoverBySchoolBetweenDate($school_id, $dateMin = null, $dateMax = null) {
        if (is_null($dateMin))
            $dateMin = (new \DateTime())->modify('-6 days');
        if (is_null($dateMax))
            $dateMax = new \DateTime();

        $qb = $this->_em->createQueryBuilder()
           ->select('DATE(p.createdAt) as date, SUM(p.price) as turnover', 'COUNT(p) as nbTransaction')
           ->from($this->_entityName, 'p')
           ->where('p.school = :school_id', 'p.createdAt >= :date_min', 'p.updatedAt <= :date_max')
           ->setParameter(':school_id', $school_id)
           ->setParameter(':date_min', $dateMin->format('Y-m-d 00:00:00'))
           ->setParameter(':date_max', $dateMax->format('Y-m-d 23:59:59'))
           ->groupBy('date, p.school');

        $result = $qb->getQuery()->getResult();
        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($dateMin, $interval, $dateMax->modify( '+1 day' ));

        $data = array();

        foreach($dateRange as $date){
            foreach ($result as $r) {
                if ($r['date'] == $date->format("Y-m-d")) {
                    $data[] = $r;
                    continue(2);
                }
            }

            $data[] = array(
                'date' => $date->format("Y-m-d"),
                'nbTransaction' => null,
                'turnover' => null
            );
        }

        return $data;
    }
}
