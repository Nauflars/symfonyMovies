<?php

namespace App\Controller;

use App\Service\MessageService;
use App\Service\ProcessingService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController
{
    private $messageService;
    private $processService;

    public function __construct(MessageService $messageService, ProcessingService $processService)
    {
        $this->messageService = $messageService;
        $this->processService = $processService;
    }

    /**
     * @Route("/send-message/{numberOfMessages}", name="send_message", methods={"GET"})
     */
    public function createMessages($numberOfMessages): JsonResponse
    {
        $this->messageService->createMessage($numberOfMessages);

        return new JsonResponse(['status' => 'Sent!']);
    }

     /**
     * @Route("/send-process/{numberOfMessages}", name="send_process", methods={"GET"})
     */
    public function createProcess($numberOfMessages): JsonResponse
    {
        $this->processService->createProcess($numberOfMessages);

        return new JsonResponse(['status' => 'Sent!']);
    }
}