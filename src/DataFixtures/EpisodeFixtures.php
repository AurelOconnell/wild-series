<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
        const EPISODES = [
            [
            'title' => 'Winter is coming',
            'number' => 1,
            'synopsis' => 'Eddard Stark est déchiré entre sa famille et un vieil ami lorsqu\'on lui demande de servir aux côtés du roi Robert Baratheon ;
            Viserys prévoit de marier sa sœur à un seigneur de guerre nomade en échange d\'une armée.',
            'season' => 'season1_Games of Thrones'
            ],
            [
            'title' => 'The Kingsroad',
            'number' => 2,
            'synopsis' => 'Pendant que Bran se remet de sa chute, Ned n\'emmène que ses filles à Port-Réal. 
            Jon Snow accompagne son oncle Benjen au Mur. Tyrion les rejoint.',
            'season' => 'season1_Games of Thrones'
            ],
            [
            'title' => 'Lord Snow',
            'number' => 3,
            'synopsis' => 'Jon commence sa formation au sein de la Garde de nuit ; Ned affronte son passé et son avenir à Port-Réal ; 
            Daenerys se retrouve en désaccord avec Vis.',
            'season' => 'season1_Games of Thrones'
            ],
            [
            'title' => 'The North Remembers',
            'number' => 1,
            'synopsis' => 'Tyrion arrives at King\'s Landing to take his father\'s place as Hand of the King. Stannis Baratheon plans to take the Iron Throne for his own. 
            Robb tries to decide his next move in the war. The Night\'s Watch arrive at the house of Craster.',
            'season' => 'season2_Games of Thrones'
            ],
            [
            'title' => 'The Night Lands',
            'number' => 2,
            'synopsis' => 'Arya makes friends with Gendry. Tyrion tries to take control of the Small Council. 
            Theon arrives at his home, Pyke, in order to persuade his father into helping Robb with the war. Jon tries to investigate Craster\'s secret.
            ',
            'season' => 'season2_Games of Thrones'
            ],
            [
            'title' => 'What Is Dead May Never Die',
            'number' => 3,
            'synopsis' => 'Tyrion tries to see who he can trust in the Small Council. Catelyn visits Renly to try and persuade him to join Robb in the war. 
            Theon must decide if his loyalties lie with his own family or with Robb.',
            'season' => 'season2_Games of Thrones'
            ],
            [
            'title' => 'Valar Dohaeris',
            'number' => 1,
            'synopsis' => 'Jon is brought before Mance Rayder, the King Beyond the Wall, while the Night\'s Watch survivors retreat south. 
            In King\'s Landing, Tyrion asks for his reward. Littlefinger offers Sansa a way out.',
            'season' => 'season3_Games of Thrones'
            ],
            [
            'title' => 'Dark Wings, Dark Words',
            'number' => 2,
            'synopsis' => 'Bran and company meet Jojen and Meera Reed. Arya, Gendry, and Hot Pie meet the Brotherhood. 
            Jaime travels through the wilderness with Brienne. Sansa confesses her true feelings about Joffery to Margaery.',
            'season' => 'season3_Games of Thrones'
            ],
            [
            'title' => 'Walk of Punishment',
            'number' => 3,
            'synopsis' => 'Robb and Catelyn arrive at Riverrun for Lord Hoster Tully\'s funeral. 
            Tywin names Tyrion the new Master of Coin. Arya says goodbye to Hot Pie. The Night\'s Watch returns to Craster\'s. Brienne and Jaime are taken prisoner.',
            'season' => 'season3_Games of Thrones'
            ],
        ];

        //src/DataFixtures/EpisodeFixtures.php
        public function load(ObjectManager $manager): void
        {
        //first episode
        foreach (self::EPISODES as $episodeData) {
            $episode = new Episode();
            $episode->setTitle($episodeData['title']);
            $episode->setNumber($episodeData['number']);
            $episode->setSynopsis($episodeData['synopsis']);
            $episode->setSeason($this->getReference($episodeData['season']));
            $manager->persist($episode);
        }

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

