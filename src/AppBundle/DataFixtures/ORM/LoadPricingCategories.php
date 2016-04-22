<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PricingCategory;

class LoadPricingCategories extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        foreach ($this->getPricingNames() as $pricing_name) {
            $pricingCategory = new PricingCategory();
            $pricingCategory->setName($pricing_name);

            $this->addReference('registration-pricing', $pricingCategory);

            $manager->persist($pricingCategory);
        }

        $manager->flush();
    }

    private function getPricingNames() {
        return array(
            'Tarif inscription'
        );
    }

    public function getOrder()
    {
        return 20;
    }
}
?>
