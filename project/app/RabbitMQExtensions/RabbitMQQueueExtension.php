<?php

namespace App\RabbitMQExtensions;

use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\RabbitMQQueue;
use Illuminate\Support\Arr;
use PhpAmqpLib\Connection\AbstractConnection;

class RabbitMQQueueExtension extends RabbitMQQueue
{
    /**
     * Determine all publish properties.
     *
     * @param $queue
     * @param array $options
     * @return array
     */
    protected function publishProperties($queue, array $options = []): array
    {
        $queue = $this->getQueue($queue);

        $this->setOptions(config("rabbitmq_options.{$queue}") ?? []);

        $attempts = Arr::get($options, 'attempts') ?: 0;

        $destination = $this->getRoutingKey($queue);
        $exchange = $this->getExchange();
        $exchangeType = $this->getExchangeType();

        return [$destination, $exchange, $exchangeType, $attempts];
    }

    /**
     * Set options for Queue
     *
     * @param array $options
     * @return this
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
}