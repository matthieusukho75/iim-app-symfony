<?php

namespace App\Resolver;


use App\Repository\CategoryRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class CategoriesResolver implements ResolverInterface, AliasedInterface {

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \App\Entity\Category[]
     */
    public function resolve()
    {
        return $this->categoryRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        // TODO: Implement getAliases() method.
        return[
            'resolve' => 'Categories',
        ];
    }
}