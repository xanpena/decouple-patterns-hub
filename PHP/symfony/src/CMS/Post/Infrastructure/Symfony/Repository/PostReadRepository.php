<?php

declare(strict_types=1);

namespace App\CMS\Post\Infrastructure\Symfony\Repository;

use App\CMS\Post\Application\Contracts\PostReadRepositoryInterface;
use App\CMS\Post\Application\Assembler\PostAssembler;
use App\CMS\Post\Application\DTO\PostDTO;
use App\Shared\Infrastructure\Symfony\Exception\ResourceNotFoundHttpException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PostReadRepository extends ServiceEntityRepository implements PostReadRepositoryInterface
{
    private PostAssembler $assembler;

    public function __construct(
        private ManagerRegistry $registry,
        private EntityManagerInterface $entityManager,
        private readonly string $className
    ) {
        parent::__construct($registry, $className);
        $this->entityManager = $entityManager;
        $this->assembler = new PostAssembler();
    }

    public function get(): array
    {
        return $this->findAll();
    }

    public function findByCriteria(array $criteria): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->leftJoin('p.user', 'u')
            ->addSelect('u')
            ->orderBy('p.id', 'DESC');

        foreach ($criteria as $field => $value) {
            $queryBuilder->andWhere("p.$field = :$field")
                ->setParameter($field, $value);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function findOne(int $id): PostDTO
    {
        $post = $this->find($id)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.email', 'users.id as user_id')
            ->first();

        $this->guardAgainstPostNotFound($post, $id);

        return $this->assembler->toDTO($post);
    }

    private function guardAgainstPostNotFound(?object $post, int $id): void
    {
        if (null === $post) {
            throw ResourceNotFoundHttpException::fromMessage(sprintf('Post with ID %d not found', $id));
        }
    }

    public function paginate(int $page, int $pageSize): array
    {
        $offset = ($page - 1) * $pageSize;

        return $this->createQueryBuilder('p')
            ->leftJoin('p.user', 'u')
            ->addSelect('u')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($pageSize)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }
}
