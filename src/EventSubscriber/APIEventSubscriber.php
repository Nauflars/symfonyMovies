<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Service\MessageService;

class APIEventSubscriber implements EventSubscriberInterface
{
     private $messageService;
    public function __construct(MessageService $messageService){ 
           $this->messageService = $messageService;
    }

    public function onControllerEvent(ControllerEvent $event)
    {
        //test
            $numMessages = 2;
           $this->messageService->createMessage($numMessages);
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
