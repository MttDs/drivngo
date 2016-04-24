<?php

namespace BackBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use BackBundle\Entity\Employee;

class LoadEmployees extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $employee = new Employee();
        $employee->setSchool($this->getReference('mouffetard'));
        $employee->setUser($this->getReference('manager'));
        $employee->setActive(true);
        $manager->persist($employee);

        $employee = new Employee();
        $employee->setSchool($this->getReference('mouffetard'));
        $employee->setUser($this->getReference('instructor'));
        $employee->setActive(true);
        $manager->persist($employee);

        $employee = new Employee();
        $employee->setSchool($this->getReference('mouffetard'));
        $employee->setUser($this->getReference('secretary'));
        $employee->setActive(true);
        $manager->persist($employee);

        $manager->flush();
    }

    public function getOrder()
    {
        return 40;
    }
}
?>
