<?php

namespace App\RabbitMQExtensions;

use Illuminate\Contracts\Queue\Queue;
use PhpAmqpLib\Connection\AbstractConnection;
use App\RabbitMQExtensions\RabbitMQQueueExtension;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Connectors\RabbitMQConnector;
use VladimirYuldashev\LaravelQueueRabbitMQ\Horizon\RabbitMQQueue as HorizonRabbitMQQueue;

class RabbitMQConnectorExtension extends RabbitMQConnector
{
    /**
     * Create a queue for the worker.
     *
     * @param string $worker
     * @param AbstractConnection $connection
     * @param string $queue
     * @param array $options
     * @return HorizonRabbitMQQueue|RabbitMQQueueExtension|Queue
     */
    protected function createQueue(string $worker, AbstractConnection $connection, string $queue, array $options = [])
    {
        switch ($worker) {
            case 'default':
                return new RabbitMQQueueExtension($connection, $queue, $options);
            case 'horizon':
                return new HorizonRabbitMQQueue($connection, $queue, $options);
            default:
                return new $worker($connection, $queue, $options);
        }
    }
}
