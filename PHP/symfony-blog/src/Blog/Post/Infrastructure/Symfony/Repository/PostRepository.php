<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Symfony\Repository;

use App\Blog\Post\Application\Contracts\PostRepositoryInterface;
use App\Blog\Post\Domain\Post;
use App\Blog\Post\Domain\ValueObjects\PostId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Post::class);
        $this->entityManager = $entityManager;
    }

    public function get(): array
    {
        return $this->findAll();
    }

    public function findOne(PostId $postId): ?Post
    {
        return $this->find($postId->value());
    }

    public function save(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function update(PostId $postId, Post $post): void
    {
        $existingPost = $this->find($postId);

        if (null !== $existingPost) {
            $existingPost->updateFrom($post);
            $this->entityManager->flush();
        }
    }

    public function delete(PostId $postId): void
    {
        $post = $this->find($postId);

        if (null !== $post) {
            $this->entityManager->remove($post);
            $this->entityManager->flush();
        }
    }
}
