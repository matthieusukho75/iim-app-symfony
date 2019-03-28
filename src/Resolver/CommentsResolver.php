<?php

namespace App\Resolver;


use App\Repository\CommentRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class CommentsResolver implements ResolverInterface, AliasedInterface {

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     *
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return \App\Entity\Comment[]
     */
    public function resolve()
    {
        return $this->commentRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases()
    {
        // TODO: Implement getAliases() method.
        return[
            'resolve' => 'Comments',
        ];
    }
}