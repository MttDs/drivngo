<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Pricing;

class LoadPricings extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        foreach ($this->getPricings() as $pricing_values) {
            $pricing = new Pricing();
            $pricing->setName($pricing_values['name']);
            $pricing->setPrice($pricing_values['price']);
            $pricing->setActive(true);
            $pricing->setPricingCategory($this->getReference('registration-pricing'));
            $pricing->setSchool($this->getReference('mouffetard'));

            $this->addReference($pricing_values['ref'], $pricing);

            $manager->persist($pricing);
        }

        $manager->flush();
    }

    private function getPricings() {
        return array(
            array(
                'name'  => "Tarif code",
                'price' => "335",
                'ref'   => 'pricing-code'
            ),
            array(
                'name'  => "Tarif code et conduite",
                'price' => "544",
                'ref'   => 'pricing-code-driving'
            ),
        );
    }

    public function getOrder()
    {
        return 30;
    }
}
?>
