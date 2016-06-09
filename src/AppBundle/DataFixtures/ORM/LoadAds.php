<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Ad;

class LoadAds extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $ad = new Ad();
        $ad->setFileName('../../img/pub-sadaqa-header.jpg');
        $ad->setUrl('http://google.fr');
        $ad->setSchool($this->getReference('mouffetard'));
        $ad->setAdType($this->getReference('ad-type-header'));

        $manager->persist($ad);

        $ad = new Ad();
        $ad->setFileName('../../img/comeon-pub-sidebar.jpg');
        $ad->setUrl('http://google.fr');
        $ad->setSchool($this->getReference('mouffetard'));
        $ad->setAdType($this->getReference('ad-type-sidebar1'));

        $manager->persist($ad);

        $ad = new Ad();
        $ad->setFileName('../../img/comeon-pub-sidebar2.jpg');
        $ad->setUrl('http://google.fr');
        $ad->setSchool($this->getReference('mouffetard'));
        $ad->setAdType($this->getReference('ad-type-sidebar2'));

        $manager->persist($ad);

        $ad = new Ad();
        $ad->setFileName('../../img/LOSCFR_933x124_0.jpg');
        $ad->setUrl('http://google.fr');
        $ad->setSchool($this->getReference('mouffetard'));
        $ad->setAdType($this->getReference('ad-type-footer'));

        $manager->persist($ad);

        $ad = new Ad();
        $ad->setFileName('../../img/comeon-pub-sidebar.jpg');
        $ad->setUrl('http://google.fr');
        $ad->setSchool($this->getReference('cluny'));
        $ad->setAdType($this->getReference('ad-type-sidebar1'));

        $manager->persist($ad);
        $manager->flush();
    }

    public function getOrder()
    {
        return 90;
    }
}
?>
