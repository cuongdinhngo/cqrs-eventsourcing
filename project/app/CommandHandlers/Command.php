<?php

namespace App\CommandHandlers;

abstract class Command
{
    /**
     * Handle Command Class
     *
     * @param string $commandClass
     * @param array $data
     * @return void
     */
    abstract public function handle(string $commandClass, array $data = []);
}