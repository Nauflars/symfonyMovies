<?php

namespace App\Service;

use App\Rabbit\Processing\ProcessingProducer;
use Faker\Factory;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProcessingService
{
    private $processingProducer;

    public function __construct(ProcessingProducer $processingProducer)
    {
        $this->processingProducer = $processingProducer;
    }

    public function createProcess(int $numberOfUsers): JsonResponse
    {
        $faker = Factory::create();

        for ($i=0; $i<$numberOfUsers; $i++) {
            $message = json_encode([
                'consumer' => 'process',
                'server' => 'symfony',
                'sender' => $faker->companyEmail,
                'receiver' => $faker->email,
                'message' => $faker->text,
            ]);

            $this->processingProducer->publish($message);
        }

        return new JsonResponse(['status' => 'Sent!']);
    }
}