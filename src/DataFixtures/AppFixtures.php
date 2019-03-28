<?php

namespace App\DataFixtures;

use App\Repository\AuthorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Article;
use App\Entity\Author;
use App\Entity\Comment;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $categories = [];
        $comments = [];
        $articles = [];




        for ($i = 0; $i < 10; $i++){
            $category = new Category();
            $category->setName('Category' . $i);
            $manager->persist($category);

            $categories[] = $category;
        }

        for ($i = 0; $i < 10; $i++){
            $article = new Article();
            $article->setName('Article' . $i);
            $article->setCategory($categories[rand(0,9)]);
            $manager->persist($article);
            $articles[] = $article;

        }


        //Comments fixtures
        for ($i = 0; $i < 10; $i++){
            $comment = new Comment();
            $comment->setName('Comment' . $i);
            $comment->setArticle($articles[rand(0,9)]);
            $manager->persist($comment);
            $comments[] = $comment;
        }

        $author= new Author();
        $author->setName('Author');
        $author->setArticle($articles[rand(0,9)]);
        $manager->persist($author);

        $manager->flush();
    }
}
