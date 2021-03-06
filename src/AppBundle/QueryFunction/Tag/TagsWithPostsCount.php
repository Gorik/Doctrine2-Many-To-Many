<?php

namespace AppBundle\QueryFunction\Tag;

use AppBundle\Entity\Tag;

final class TagsWithPostsCount
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

        return $qb->select('t.title', 'COUNT(p.id) as countOfPosts')
            ->from(Tag::class, 't')
            ->leftJoin('t.posts', 'p')
            ->groupBy('t.id')
            ->orderBy('t.title')
            ->getQuery()
            ->getResult();
    }
}