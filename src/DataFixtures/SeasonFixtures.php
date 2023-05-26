<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //src/DataFixtures/SeasonFixtures.php
        $season = new Season();
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_Game of Thrones'));
        $season->setYear(2011);
        $season->setDescription('Spoiler alert : Sean Bean meurt à la fin.');
        $this->addReference('season1_Game of Thrones', $season);
        $manager->persist($season);

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
