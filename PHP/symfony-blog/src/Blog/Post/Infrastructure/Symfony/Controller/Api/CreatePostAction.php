<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Symfony\Controller\Api;

use App\Blog\Post\Application\Command\CreatePost\CreatePostCommand;
use App\Blog\Post\Application\Command\CreatePost\CreatePostCommandHandler;
use App\Shared\Infrastructure\Symfony\Contracts\ControllerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostAction extends AbstractController implements ControllerInterface
{
    private CreatePostCommandHandler $commandHandler;

    public function __construct(CreatePostCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;
    }

    #[Route('/api/posts', methods: 'Post')]
    #[OA\RequestBody(
        required: true,
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
        response: 201,
        description: 'Post created successfully'
    )]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $postData = json_decode($request->getContent(), true);

            $command = new CreatePostCommand(
                $postData['id'],
                $postData['title'],
                $postData['body'],
                $postData['authorId'],
                $postData['authorEmail'],
                $postData['authorName']
            );

            $this->commandHandler->__invoke($command);

            return new JsonResponse(['message' => 'Post created successfully'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
