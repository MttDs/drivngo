<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $manager->persist($this->getUser());
        $manager->persist($this->getManager());
        $manager->persist($this->getInstructor());
        $manager->persist($this->getSecretary());
        $manager->persist($this->getAdmin());

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    private function getUser()
    {
        $user = new User();
        $user->setUsername('user');
        $user->setFirstname('Michel');
        $user->setLastname('Bashares');
        $user->setPlainPassword('soleil');
        $user->setEmail('user@gmail.com');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_STUDENT'));

        $this->addReference('user', $user);

        return $user;
    }

    private function getManager()
    {
        $user = new User();
        $user->setUsername('manager');
        $user->setFirstname('Bill');
        $user->setLastname('Gates');
        $user->setPlainPassword('soleil');
        $user->setEmail('manager@gmail.com');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_MANAGER'));

        $this->addReference('manager', $user);

        return $user;
    }

    private function getInstructor()
    {
        $user = new User();
        $user->setUsername('moniteur');
        $user->setFirstname('Temi');
        $user->setLastname('Ifekoila');
        $user->setPlainPassword('soleil');
        $user->setEmail('moniteur@gmail.com');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_INSTRUCTOR'));

        $this->addReference('instructor', $user);

        return $user;
    }

    private function getSecretary()
    {
        $user = new User();
        $user->setUsername('secretaire');
        $user->setFirstname('Matthias-Kelvin');
        $user->setLastname('Khan-Shapûur');
        $user->setPlainPassword('soleil');
        $user->setEmail('secretary@gmail.com');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_SECRETARY'));

        $this->addReference('secretary', $user);

        return $user;
    }

    private function getAdmin()
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setFirstname('Jean-Philipe');
        $user->setLastname('Brun');
        $user->setPlainPassword('soleil');
        $user->setEmail('adminy@gmail.com');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_SUPER_ADMIN'));

        $this->addReference('admin', $user);

        return $user;
    }
}
?>
