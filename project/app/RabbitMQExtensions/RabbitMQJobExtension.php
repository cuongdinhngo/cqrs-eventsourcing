<?php

namespace App\RabbitMQExtensions;

use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;
use Illuminate\Container\Container;
use PhpAmqpLib\Message\AMQPMessage;
use App\RabbitMQExtensions\RabbitMQQueueExtension;

class RabbitMQJobExtension extends RabbitMQJob
{
    /**
     * The RabbitMQ queue instance.
     *
     * @var RabbitMQQueueExtension
     */
    protected $rabbitmq;

    /**
     * The RabbitMQ message instance.
     *
     * @var AMQPMessage
     */
    protected $message;

    /**
     * The JSON decoded version of "$message".
     *
     * @var array
     */
    protected $decoded;

    public function __construct(
        Container $container,
        RabbitMQQueueExtension $rabbitmq,
        AMQPMessage $message,
        string $connectionName,
        string $queue
    ) {
        $this->container = $container;
        $this->rabbitmq = $rabbitmq;
        $this->message = $message;
        $this->connectionName = $connectionName;
        $this->queue = $queue;
        $this->decoded = $this->payload();
    }
}
