<?php

namespace App\CommandHandlers;

class CommandFactory extends Command
{
    /**
     * Handle Command Class
     *
     * @param string $commandClass
     * @param array $data
     * @return void
     */
    public function handle(string $commandClass, array $data = [])
    {
        return app($commandClass)->execute($data);
    }
}