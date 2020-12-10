<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Actor;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danai Gurira'
    ];

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {
        $actor = new Actor();
        $actor->setName($actorName);
        $actor->addProgram($this->getReference('program_0'));
        $manager->persist($actor);
        $this->addReference('actor_' . $key, $actor);
    }
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 4; $i <= 50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->firstName.' '.$faker->lastName);
            $actor->addProgram($this->getReference('program_' . rand(1, 5)));
            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
        }

        $manager->flush();
    }
}
