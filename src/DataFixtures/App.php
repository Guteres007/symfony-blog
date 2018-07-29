<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class App extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $article = new Article();
         $article->setTitle("Title");
         $article->setContent("Content");
         $article->setSlug("clanek");
         $article->setPublishedAt(new \DateTime("2018-12-3"));
         $manager->persist($article);

         $article = new Article();
         $article->setTitle("Title2");
         $article->setContent("Content2");
         $article->setSlug("clanek2");
         $article->setPublishedAt(new \DateTime("2018-12-4"));
         $manager->persist($article);

        $manager->flush();
    }
}
