<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Payment;

class LoadPayments extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $this->loadDay1($manager);
        $this->loadDay2($manager);
        $this->loadDay3($manager);
        $this->loadDayN($manager);
    }

    protected function loadDay1($manager) {
        $payment = new Payment();
        $pricing = $this->getReference('pricing-code');

        $payment->setCreatedAt(new \DateTime());
        $payment->setUpdatedAt(new \DateTime());
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();
        $pricing = $this->getReference('pricing-code-driving');

        $payment->setCreatedAt(new \DateTime());
        $payment->setUpdatedAt(new \DateTime());
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();
        $payment->setCreatedAt(new \DateTime());
        $payment->setUpdatedAt(new \DateTime());
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('cluny'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $manager->flush();
    }

    protected function loadDay2($manager) {
        $payment = new Payment();
        $pricing = $this->getReference('pricing-code');

        $payment->setCreatedAt((new \DateTime())->modify('-24 hours'));
        $payment->setUpdatedAt((new \DateTime())->modify('-24 hours'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();
        $pricing = $this->getReference('pricing-code-driving');

        $payment->setCreatedAt((new \DateTime())->modify('-24 hours'));
        $payment->setUpdatedAt((new \DateTime())->modify('-24 hours'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();

        $payment->setCreatedAt((new \DateTime())->modify('-24 hours'));
        $payment->setUpdatedAt((new \DateTime())->modify('-24 hours'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $manager->flush();
    }

    protected function loadDay3($manager) {
        $payment = new Payment();
        $pricing = $this->getReference('pricing-code');

        $payment->setCreatedAt((new \DateTime())->modify('-48 hours'));
        $payment->setUpdatedAt((new \DateTime())->modify('-48 hours'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();

        $payment->setCreatedAt((new \DateTime())->modify('-48 hours'));
        $payment->setUpdatedAt((new \DateTime())->modify('-48 hours'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();

        $payment->setCreatedAt((new \DateTime())->modify('-48 hours'));
        $payment->setUpdatedAt((new \DateTime())->modify('-48 hours'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('cluny'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $manager->flush();
    }

    protected function loadDayN($manager) {
        $payment = new Payment();
        $pricing = $this->getReference('pricing-code');

        $payment->setCreatedAt((new \DateTime())->modify('-2 weeks'));
        $payment->setUpdatedAt((new \DateTime())->modify('-2 weeks'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();

        $payment->setCreatedAt((new \DateTime())->modify('-2 weeks'));
        $payment->setUpdatedAt((new \DateTime())->modify('-2 weeks'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('mouffetard'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $payment = new Payment();

        $payment->setCreatedAt((new \DateTime())->modify('-2 weeks'));
        $payment->setUpdatedAt((new \DateTime())->modify('-2 weeks'));
        $payment->setUser($this->getReference('user'));
        $payment->setSchool($this->getReference('cluny'));
        $payment->setPricing($pricing);
        $payment->setPrice($pricing->getPrice());
        $manager->persist($payment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 60;
    }
}
?>
