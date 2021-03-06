<?php

namespace AppBundle\QueryFunction\Post;

use AppBundle\Entity\Post;

final class PostsWithTags
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke()
    {
        $qb = $this->em->createQueryBuilder();

        return $qb->select('p', 't')
            ->from(Post::class, 'p')
            ->leftJoin('p.tags', 't')
            ->orderBy('p.publishedAt')
            ->getQuery()
            ->getResult();
    }
}