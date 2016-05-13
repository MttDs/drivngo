<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackBundle\Entity\Report;

class LoadReports extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $report = new Report();
        $report->setSchool($this->getReference('mouffetard'));
        $report->setVoter($this->getReference('user'));
        $report->setUser($this->getReference('instructor'));
        $report->setRating(5);
        $report->setMessage('Top ! Merci pour cette leçon !');
        $report->setCreatedAt(new \DateTime());

        $manager->persist($report);

        $report = new Report();
        $report->setSchool($this->getReference('mouffetard'));
        $report->setVoter($this->getReference('instructor'));
        $report->setUser($this->getReference('user'));
        $report->setRating(2);
        $report->setMessage('Travaillez les créneaux ! Restez toujours mettre de votre vehicule !');
        $report->setCreatedAt(new \DateTime());

        $manager->persist($report);

        $report = new Report();
        $report->setSchool($this->getReference('mouffetard'));
        $report->setVoter($this->getReference('instructor'));
        $report->setUser($this->getReference('user'));
        $report->setRating(4);
        $report->setMessage('De mieux en mieux ! Vous êtes bientôt prêt !');
        $report->setCreatedAt(new \DateTime());

        $manager->persist($report);

        $manager->flush();
    }

    public function getOrder()
    {
        return 80;
    }
}
?>
