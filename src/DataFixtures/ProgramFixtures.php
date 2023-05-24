<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'Game of Thrones',
            'synopsis' => 'Familles qui se mettent sur la tronche pour se poser sur un fauteuil',
            'category' => 'Fantastique'
        ],
        [
            'title' => 'Wednesday',
            'synopsis' => 'Wednesday Adams va à l\'école',
            'category' => 'Fantastique'
        ],
        [
            'title' => 'Friends',
            'synopsis' => 'Des amis en colocation à New York',
            'category' => 'Comédie'
        ],
        [
            'title' => 'One Piece',
            'synopsis' => 'Un garçon élastique veut devenir le Roi des Pirates',
            'category' => 'Anime'
        ],
        [
            'title' => 'The Mandalorian',
            'synopsis' => 'Un guerrier protège un enfant des méchants de la galaxie',
            'category' => 'Science fiction'
        ]
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference('category_' . $programData['category']));
            $this->addReference('program_' . $programData['title'], $program);
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        //return all fixtures classes which ProgramFixtures depends of
        return [
            CategoryFixtures::class,
        ];
    }
}
