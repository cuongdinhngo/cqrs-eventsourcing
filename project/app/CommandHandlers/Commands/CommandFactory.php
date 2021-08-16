<?php

namespace App\CommandHandlers\Commands;

class CommandFactory extends Command
{
    /**
     * Factory method
     *
     * @param string $concreteClass
     * @return void
     */
    public function factoryMethod(string $concreteClass)
    {
        return app($concreteClass);
    }
}