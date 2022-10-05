<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use App\Responses\APIResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onExceptionEvent(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $request   = $event->getRequest();
        
        $response = $this->createApiResponse($exception);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            ExceptionEvent::class => 'onExceptionEvent',
        ];
    }

    private function createApiResponse(\Exception $exception)
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
        $errors     = [];
        return new APIResponse($exception->getMessage(), null, $errors, $statusCode);
    }
}
