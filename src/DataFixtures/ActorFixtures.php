<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $programs = $manager->getRepository(Program::class)->findAll();

        foreach (ProgramFixtures::PROGRAMS as $programData) {
            for ($i = 0; $i <= 10; $i++) {
                $actor = new Actor();
                $actor->setName($faker->firstname() . " " . $faker->lastname());

                $randomPrograms = $faker->randomElements($programs, 3);
                foreach ($randomPrograms as $program) {
                    $actor->addProgram($program);
                }
            $manager->persist($actor);
        }
        $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}
