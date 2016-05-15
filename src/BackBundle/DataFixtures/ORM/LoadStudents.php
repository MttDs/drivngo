<?php

namespace BackBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use BackBundle\Entity\Student;

class LoadStudents extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $student = new Student();
        $student->setSchool($this->getReference('mouffetard'));
        $student->setUser($this->getReference('user'));
        $student->setActive(true);
        $student->setELearning(true);
        $manager->persist($student);

        $manager->flush();
    }

    public function getOrder()
    {
        return 50;
    }
}
?>
