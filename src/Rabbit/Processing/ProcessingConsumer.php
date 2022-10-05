<?php

namespace App\Rabbit\Processing;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ProcessingConsumer implements ConsumerInterface
{

    public function execute(AMQPMessage $msg)
    {
        $message = json_decode($msg->body, true);
        echo 'consumer '.$message['consumer']."\n";
        echo 'server '.$message['server']."\n";
        echo 'Received a message from '.$message['sender']."\n";
        echo 'Destination '.$message['receiver']."\n";
        echo 'Message: '.$message['message']."\n";

    }
}