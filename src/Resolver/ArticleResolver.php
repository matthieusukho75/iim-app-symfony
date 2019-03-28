<?php

namespace App\Resolver;

use App\Repository\ArticleRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class ArticleResolver implements ResolverInterface, AliasedInterface {

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param int $id
     * @return \App\Entity\Article
     */
    public function resolve(int $id)
    {
        return $this->articleRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        // TODO: Implement getAliases() method.
        return[
            'resolve' => 'Article',
        ];
    }
}