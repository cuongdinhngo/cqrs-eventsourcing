<?php

namespace App\CommandHandlers\Commands;

abstract class Command
{
    /**
     * Factory method
     */
    abstract public function factoryMethod(string $concreteClass);

    /**
     * Handle Command Class
     *
     * @param string $commandClass
     * @param array $data
     * @return void
     */
    public function handle(string $commandClass, array $data = [])
    {
        $commandHandler = $this->factoryMethod($commandClass);
        return $commandHandler->execute($data);
    }
}