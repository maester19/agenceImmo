<?php

namespace App\DataFixtures;

use App\Entity\Properties;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100 ; $i++ )
        {
            $property = new Properties;
            $property
                ->setTitle($faker->words(3,true))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setRoom($faker->numberbetween(2,10))
                ->setBedroom($faker->numberbetween(1,9))
                ->setFloor($faker->numberbetween(0,15))
                ->setPrice($faker->numberbetween(100000,1000000))
                ->setHeat($faker->numberbetween(0,count(Properties::HEAT) - 1))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setSolde(false);
                $manager->persist($property);
        }
        
        $manager->flush();
    }
}
