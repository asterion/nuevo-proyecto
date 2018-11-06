<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('es_ES');

        for ($i=0; $i < 5; $i++) {
            $product = new Product();

            $product->setName($faker->unique()->sentence(3));
            $product->setDescription($faker->sentence(7));
            $product->setCode(sprintf('%04s', ($i+1)));
            $product->setStock(rand(0, 100));
            $product->setImage(['001.jpg', '002.jpg', '003.jpg', '004.png', '005.jpg'][rand(0,4)]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
