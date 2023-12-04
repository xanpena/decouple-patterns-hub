<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class JsonRequestParserRequestListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $content = $request->getContent();
        if (empty($content)) {
            return;
        }
        if (!$this->isJsonRequest($request)) {
            return;
        }
        if (!$this->transformJsonBody($request)) {
            $response = new JsonResponse(['message' => 'Unable to parse request.'], 400);
            $event->setResponse($response);
        }
    }

    private function isJsonRequest(Request $request): bool
    {
        return 'json' === $request->getContentTypeFormat();
    }

    private function transformJsonBody(Request $request): bool
    {
        $data = json_decode($request->getContent(), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return false;
        }

        if (null === $data) {
            return true;
        }

        if (!is_array($data)) {
            return false;
        }

        $request->request->replace($data);

        return true;
    }
}
