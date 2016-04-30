<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\AdType;

class LoadAdTypes extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        foreach ($this->getNames() as $ad_name) {
            $adType = new AdType();
            $adType->setName($ad_name);

            $this->addReference('ad-type-'.strtolower($ad_name), $adType);

            $manager->persist($adType);
        }

        $manager->flush();
    }

    private function getNames() {
        return array(
            'Header',
            'Sidebar1',
            'Sidebar2',
            'Footer'
        );
    }

    public function getOrder()
    {
        return 70;
    }
}
?>
