<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create();

        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < 35; $i++) {
            $article = (new Article())
                ->setCategory($faker->randomElement($categories))
                ->setTitle($faker->text(60))
                ->setContent($faker->paragraphs(3, true))
                ->setPublished($faker->boolean(80))
                ->setDate($faker->dateTime);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
