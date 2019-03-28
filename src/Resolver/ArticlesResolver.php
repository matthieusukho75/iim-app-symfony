<?php

namespace App\Resolver;

use App\Repository\ArticleRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class ArticlesResolver implements ResolverInterface, AliasedInterface {

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
     * @return \App\Entity\Article[]
     */
    public function resolve()
    {
        return $this->articleRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        // TODO: Implement getAliases() method.
        return[
            'resolve' => 'Articles',
        ];
    }
}