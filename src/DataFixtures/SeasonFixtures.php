<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    /*const SEASONS = [
        [
            'number' => 1,
            'program' => 'Games of Thrones',
            'year' => '2011',
            'description' => 'Spoiler alert : Sean Bean meurt à la fin.'
        ],
        [
            'number' => 2,
            'program' => 'Games of Thrones',
            'year' => '2012',
            'description' => 'Ca continue à se battre pour un tabouret, à la fin 2 ou 3 personnes meurent, tout ça.'
        ],
        [
            'number' => 3,
            'program' => 'Games of Thrones',
            'year' => '2013',
            'description' => 'Le nain qui boit et sait des trucs, continue son petit bonhomme de chemin.'
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $seasonData) {
            $season = new Season();
            $season->setNumber($seasonData['number']);
            $season->setProgram($this->getReference('program_' . $seasonData['program']));
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);
            $manager->persist($season);
            $this->addReference('season' . $seasonData['number'] . '_' . $seasonData['program'], $season);
        }

        $manager->flush();
    }*/

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $programData) {
            for ($i = 1; $i <= 5; $i++) {
                $season = new Season();
                $season->setNumber($i);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($this->getReference('program_' . $programData['title']));
                $this->addReference('season' . $i . '_' . $programData['title'], $season);

                $manager->persist($season);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        //return all fixtures classes which SeasonFixtures depends of
        return [
            ProgramFixtures::class,
        ];
    }
}
