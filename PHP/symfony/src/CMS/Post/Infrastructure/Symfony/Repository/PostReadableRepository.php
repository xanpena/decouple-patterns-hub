<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Symfony\Repository;

use App\Blog\Post\Application\Contracts\PostReadableRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PostReadableRepository extends PostReadRepository implements PostReadableRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, $entityManager);
    }

    public function findAll(): array
    {
        return $this->findBy(['status' => 1]);
    }
}
