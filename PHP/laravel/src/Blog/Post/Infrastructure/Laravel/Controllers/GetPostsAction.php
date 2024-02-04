<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Laravel\Controllers;

use App\Blog\Post\Application\Query\GetPostsQueryHandler;
use App\Blog\Post\Application\Query\GetPostsQuery;
use App\Shared\Infrastructure\Laravel\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class GetPostsAction extends Controller
{
    private GetPostsQueryHandler $queryHandler;

    public function __construct(GetPostsQueryHandler $queryHandler)
    {

        $this->queryHandler = $queryHandler;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $query = GetPostsQuery::create();
            $posts = $this->queryHandler->__invoke($query);

            if (null === $posts) {
                return new JsonResponse(['error' => 'No results'], Response::HTTP_NOT_FOUND);
            }

            $responseData = $posts; // TODO

            $response = ['data' => $responseData];

            return new JsonResponse($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
