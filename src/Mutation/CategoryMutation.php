<?php
namespace App\Mutation;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

use App\Entity\Category;

final class CategoryMutation implements MutationInterface, AliasedInterface
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $name
     * @param int $articleId
     *
     * @return array
     *
     * @throws \Exception
     */
    public function resolve(string $name, int $articleId )
    {
        $category = new Category();
        $category->setName($name);

        $article = $this->em->getRepository(Article::class)->find($articleId);


        if (!$article instanceof Article) {
            throw new \Exception('Unknown category with id ' . $articleId);
        }

        $category->addArticle($article);


        $this->em->persist($category);
        $this->em->flush();

        return ['content' => 'ok'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewCategory',
        ];
    }
}