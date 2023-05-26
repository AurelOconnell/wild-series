<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        //src/DataFixtures/EpisodeFixtures.php

        //first episode
        $episode = new Episode();
        $episode->setTitle('Winter is coming');
        $episode->setNumber(1);
        $episode->setSynopsis('Eddard Stark est déchiré entre sa famille et un vieil ami lorsqu\'on lui demande de servir aux côtés du roi Robert Baratheon ;
         Viserys prévoit de marier sa sœur à un seigneur de guerre nomade en échange d\'une armée.');
        $episode->setSeason($this->getReference('season1_Game of Thrones'));

        //second episode
        $episode = new Episode();
        $episode->setTitle('The Kingsroad');
        $episode->setNumber(2);
        $episode->setSynopsis('Pendant que Bran se remet de sa chute, Ned n\'emmène que ses filles à Port-Réal. *
        Jon Snow accompagne son oncle Benjen au Mur. Tyrion les rejoint.');
        $episode->setSeason($this->getReference('season1_Game of Thrones'));
        
        //third episode
        $episode = new Episode();
        $episode->setTitle('Lord Snow');
        $episode->setNumber(3);
        $episode->setSynopsis('Jon commence sa formation au sein de la Garde de nuit ; Ned affronte son passé et son avenir à Port-Réal ; 
        Daenerys se retrouve en désaccord avec Vis');
        $episode->setSeason($this->getReference('season1_Game of Thrones'));

        $manager->flush();
    }

    public function getDependencies()
    {
        //return all fixtures classes which SeasonFixtures depends of
        return [
            SeasonFixtures::class,
        ];
    }
}
