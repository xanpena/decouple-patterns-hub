<?php

declare(strict_types=1);

namespace App\CMS\Post\Infrastructure\Symfony\Controller\Api;

use App\CMS\Post\Application\Command\AddPostCommand;
use App\CMS\Post\Application\Command\AddPostCommandHandler;
use App\Shared\Infrastructure\Symfony\Contracts\ControllerInterface;
use App\Shared\Infrastructure\Symfony\Exception\ValidationException;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostAction extends AbstractController implements ControllerInterface
{

    public function __construct(
        private AddPostCommandHandler $commandHandler,
        private RequestStack $requestStack
    ) {
        $this->commandHandler = $commandHandler;
        $this->requestStack = $requestStack;
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
    public function __invoke(): JsonResponse
    {
        $errors = [];

        try {
            $request = $this->requestStack->getCurrentRequest();
            $postData = json_decode($request->getContent(), true);

            $command = new AddPostCommand(
                $postData['id'],
                $postData['title'],
                $postData['body'],
                $postData['authorId'],
                $postData['authorEmail'],
                $postData['authorName']
            );

            $this->commandHandler->__invoke($command);
        } catch (ValidationException $e) {
            $errors[] = $e->getMessage();
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }

        if (!empty($errors)) {
            return new JsonResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['message' => 'Post created successfully'], Response::HTTP_CREATED);
    }
}
