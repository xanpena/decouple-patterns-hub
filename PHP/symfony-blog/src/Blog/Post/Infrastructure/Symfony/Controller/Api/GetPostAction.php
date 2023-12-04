<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Symfony\Controller\Api;

use App\Blog\Post\Application\Query\GetPostQuery;
use App\Blog\Post\Application\Query\GetPostQueryHandler;
use App\Shared\Infrastructure\Symfony\Contracts\ControllerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostAction extends AbstractController implements ControllerInterface
{
    private GetPostQueryHandler $queryHandler;

    public function __construct(GetPostQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    #[Route('/api/posts/{postId}', methods: 'GET')]
    #[OA\Parameter(
        name: 'postId',
        in: 'path',
        description: 'ID of the post',
        required: true,
    )]
    #[OA\Response(
        response: 200,
        description: 'Get a single post',
        content: new OA\JsonContent(type: 'object', properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'title', type: 'string'),
            new OA\Property(property: 'body', type: 'string'),
            new OA\Property(property: 'authorId', type: 'integer'),
            new OA\Property(property: 'authorEmail', type: 'string'),
            new OA\Property(property: 'authorName', type: 'string'),
        ])
    )]
    #[OA\Response(
        response: 404,
        description: 'Post not found'
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad request'
    )]
    public function __invoke(int $postId): JsonResponse
    {
        try {
            $query = GetPostQuery::create($postId);
            $post = $this->queryHandler->__invoke($query);

            if (null === $post) {
                return new JsonResponse(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
            }

            $responseData = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'body' => $post->getBody(),
                'authorId' => $post->getAuthorId(),
                'authorEmail' => $post->getAuthorEmail(),
                'authorName' => $post->getAuthorName(),
            ];

            $response = ['data' => $responseData];

            return new JsonResponse($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
