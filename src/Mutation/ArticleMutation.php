<?php
namespace App\Mutation;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

use App\Entity\Article;

final class ArticleMutation implements MutationInterface, AliasedInterface
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
     * @param int $authorId
     * @param int $categoryId
     * @param int $commentId
     *
     * @return array
     *
     * @throws \Exception
     */
    public function resolve(string $name, int $authorId , int $categoryId,int $commentId )
    {
        $article = new Article();
        $article->setName($name);

        $category = $this->em->getRepository(Category::class)->find($categoryId);
        $comment = $this->em->getRepository(Comment::class)->find($commentId);
        $author = $this->em->getRepository(Author::class)->find($authorId);

        if (!$category instanceof Category) {
            throw new \Exception('Unknown category with id ' . $categoryId);
        }

        if (!$comment instanceof Comment) {
            throw new \Exception('Unknown category with id ' . $commentId);
        }

        if (!$author instanceof Author) {
            throw new \Exception('Unknown category with id ' . $authorId);
        }

        $article->setCategory($category);
        $article->setAuthor($author);
        $article->addComment($comment);

        $this->em->persist($article);
        $this->em->flush();

        return ['content' => 'ok'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewArticle',
        ];
    }
}