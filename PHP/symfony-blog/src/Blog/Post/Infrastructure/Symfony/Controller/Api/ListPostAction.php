<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Symfony\Controller\Api;

use App\Blog\Post\Application\Query\GetPostsQuery;
use App\Shared\Infrastructure\Symfony\Contracts\ControllerInterface;
use App\Shared\Infrastructure\Symfony\Contracts\QueryBusInterface;
use App\Shared\Infrastructure\Symfony\Serializer\JsonSerializer;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListPostAction extends AbstractController implements ControllerInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private JsonSerializer $serializer
    ) {
    }

    #[Route('/api/posts', methods: 'GET')]
    #[OA\Response(
        response: 200,
        description: 'Get a list of posts',
        content: new OA\JsonContent(type: 'object', properties: [
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                type: 'object',
                properties: [
                    new OA\Property(property: 'id', type: 'integer'),
                    new OA\Property(property: 'title', type: 'string'),
                    new OA\Property(property: 'body', type: 'string'),
                    new OA\Property(property: 'authorId', type: 'integer'),
                    new OA\Property(property: 'authorEmail', type: 'string'),
                    new OA\Property(property: 'authorName', type: 'string'),
                ]
            )),
        ])
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad request'
    )]
    public function __invoke(): JsonResponse
    {
        $result = $this->queryBus->handle(GetPostsQuery::create());

        return JsonResponse::fromJsonString($this->serializer->serialize($result, 'json'));
    }
}
