<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Vehicle;

class LoadVehicles extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $vehicle1 = new Vehicle();
        $vehicle1->setSchool($this->getReference('mouffetard'));
        $vehicle1->setBrand('Renault');
        $vehicle1->setRef('CLIO IV');
        $vehicle1->setDescription('Renault TECH propose une offre d’adaptation auto-école la plus large du marché. Chaque véhicule bénéficie des équipements de double-commande et de contrôle indispensables au moniteur. Toutes les adaptations auto-école sont réversibles (remise à l’état initial du véhicule). Ces aménagements sont conçus et produits avec le plus grand soin dans le respect des standards qualité.');
        $vehicle1->setType('Voiture');
        $vehicle1->setLastCheck(new \DateTime('2011/10/10'));
        $vehicle1->setKilometers('10560');
        $vehicle1->setInformation('Acheté neuf');

        $manager->persist($vehicle1);

        $vehicle2 = new Vehicle();
        $vehicle2->setSchool($this->getReference('mouffetard'));
        $vehicle2->setBrand('Renault');
        $vehicle2->setRef('CLIO IV');
        $vehicle2->setDescription("Tout nos véhicules utilisés pour l'apprentissage de la conduite, sont équipés d'un dispositif de double commande de frein, débrayage et de commandes électriques principales. Ils sont de type mine « auto école » comme l'exige la législation (Article R317-25 du code de la route, partie réglementaire).Nos véhicules à double commande sont conformes à la législation française en vigueur comme l'exige l'arrêté du 8 janvier 2001 relatif à l'exploitation des établissements d'enseignement, à titre onéreux, de la conduite des véhicules à moteur et de la sécurité routière ainsi que Circulaire no 2001-5 du 25 janvier 2001 relative à l'enseignement de la conduite des véhicules à moteur et de la sécurité routière. Plusieurs marques sont proposées, selon les agences et disponibilités.");
        $vehicle2->setType('Voiture');
        $vehicle2->setLastCheck(new \DateTime('2011/10/10'));
        $vehicle2->setKilometers('10131');
        $vehicle2->setInformation('Accidenté le 5/11/2012');

        $manager->persist($vehicle2);

        $vehicle3 = new Vehicle();
        $vehicle3->setSchool($this->getReference('cluny'));
        $vehicle3->setBrand('Renault');
        $vehicle3->setRef('CLIO IV');
        $vehicle3->setDescription('Renault TECH propose une offre d’adaptation auto-école la plus large du marché. Chaque véhicule bénéficie des équipements de double-commande et de contrôle indispensables au moniteur. Toutes les adaptations auto-école sont réversibles (remise à l’état initial du véhicule). Ces aménagements sont conçus et produits avec le plus grand soin dans le respect des standards qualité.');
        $vehicle3->setType('Voiture');
        $vehicle3->setLastCheck(new \DateTime('2011/10/10'));
        $vehicle3->setKilometers('11054');
        $vehicle3->setInformation(' ');

        $manager->persist($vehicle3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}
?>
