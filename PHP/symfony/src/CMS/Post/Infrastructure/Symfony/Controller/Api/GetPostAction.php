<?php

declare(strict_types=1);

namespace App\CMS\Post\Infrastructure\Symfony\Controller\Api;

use App\CMS\Post\Application\Query\GetPostByIdQuery;
use App\CMS\Post\Application\Query\GetPostByIdQueryHandler;
use App\Shared\Infrastructure\Symfony\Contracts\ControllerInterface;
use App\Shared\Application\Exception\ApplicationException;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostAction extends AbstractController implements ControllerInterface
{
    private GetPostByIdQueryHandler $queryHandler;

    public function __construct(GetPostByIdQueryHandler $queryHandler)
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
            $query = GetPostByIdQuery::create($postId);
            $postDto = $this->queryHandler->__invoke($query);

            $response = ['data' => $postDto->toArray()];

            return new JsonResponse($response, Response::HTTP_OK);
        } catch (ApplicationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
