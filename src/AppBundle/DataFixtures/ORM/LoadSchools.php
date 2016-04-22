<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\School;

class LoadSchools extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $school = new School();

        $school->setName('L’Auto-école Cluny Saint-Germain');
        $school->setDescription(' L’Auto-école Cluny Saint-Germain met l’accent sur la qualité de sa formation grâce une équipe de moniteurs motivés et disponibles.
            Nous pouvons ainsi vous assurer un suivi personnalisé tout au long de votre apprentissage (par le même moniteur, si vous le souhaitez). Nous réalisons auprès de vous un enseignement de qualité et donc obtenons un très bon pourcentage de réussite aux examens.');
        $school->setAddress('63, boulevard Saint-Germain');
        $school->setCity('PARIS');
        $school->setPostcode('75003');
        $school->setPhoneNumber('01 43 26 42 42');
        $school->setUser($this->getReference('manager'));

        $this->addReference('cluny', $school);

        $manager->persist($school);

        $school = new School();

        $school->setName('Mouffetard auto-école');
        $school->setDescription("Le groupe Edukar est né d'une expérience familiale de près de quarante années dans le monde de la conduite.

Notre première agence, Mouffetard auto-école est fondée en 1976 dans le 5ème arrondissement de Paris. C’est la naissance de notre logo si caractéristique. Dessiné par l'illustre cartoonist anglais Ronald Searle, il fut offert en guise de remerciements après l’obtention de son permis de conduire.

Après avoir travaillé avec son père, le gérant actuel continue seul l’aventure à partir de 1988. C'est en 2012, que son fils le rejoint pour poursuivre ensemble de développement de l'entreprise familiale, qui compte désormais deux autres agences, Rennes auto-école dans le 6ème arrondissement de Paris et Ternes auto-école dans le 17ème arrondissement.");
        $school->setAddress('63, boulevard Saint-Germain');
        $school->setCity('Rennes');
        $school->setPostcode('35238');
        $school->setPhoneNumber('01 44 39 30 30');
        $school->setUser($this->getReference('manager'));

        $this->addReference('mouffetard', $school);

        $manager->persist($school);
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
?>
