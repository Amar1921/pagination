<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Langue;
use App\Repository\ArticleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    
    {
        $faker_fr = Factory::create('fr_FR');
        $faker_en = Factory::create('en');
        $faker_it = Factory::create('it_IT');
        $faker_es = Factory::create('es_ES');
       $articleRep =  $manager->getRepository(Article::class);
      // $articleRep->findBy([array('langue_id')])
        $langue1 = new Langue();
        $langue2 = new Langue();
        $langue3 = new Langue();
        $langue4 = new Langue();
        $langue1->setName('francais');
        $langue2->setName('english');
        $langue3->setName('italiano');
        $langue4->setName('espagnolo');
        $langue1->setAbreviation('FR');
        $langue2->setAbreviation('EN');
        $langue3->setAbreviation('IT');
        $langue4->setAbreviation('ES');
        $langue1->setIcon('FR');
        $langue2->setIcon('EN');
        $langue3->setIcon('IT');
        $langue4->setIcon('ES');
    
        $langues = [$langue1,$langue2,$langue3,$langue4];
        $manager->persist($langue1);
        $manager->persist($langue2);
        $manager->persist($langue3);
        $manager->persist($langue4);
        $manager->flush();
        
        
        for($i=0;$i<100;$i++){
            $id = rand(1,100);
            $lg = rand(0,3);
            $article = new Article();
            $article->setTitre($faker_fr->Text(5))
                ->setAuthor($faker_fr->name)
                ->setRawText($faker_fr->realText(200))
                ->setLangueArticle($langues[$lg])
                ->setImage("https://picsum.photos/id/".$id."/350/250");
            $manager->persist($article);
            }
        
        $manager->flush();
    }
}
