<?php

declare(strict_types=1);

namespace App\CMS\Post\Infrastructure\Symfony\Controller\Api;

use App\CMS\Post\Application\Query\GetPaginatedPostsQuery;
use App\CMS\Post\Application\Query\GetPaginatedPostsQueryHandler;
use App\Shared\Infrastructure\Symfony\Contracts\ControllerInterface;
use App\Shared\Application\Exception\ApplicationException;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexAction extends AbstractController implements ControllerInterface
{
    private GetPaginatedPostsQueryHandler $queryHandler;

    public function __construct(GetPaginatedPostsQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
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
        try {
            $query = GetPaginatedPostsQuery::create();
            $postsDto = $this->queryHandler->__invoke($query);

            $response = ['data' => array_map(fn ($postDto) => $postDto->toArray(), $postsDto)];

            return new JsonResponse($response, Response::HTTP_OK);
        } catch (ApplicationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
