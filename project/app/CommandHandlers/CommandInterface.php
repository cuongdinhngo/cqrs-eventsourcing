<?php

namespace App\CommandHandlers;

interface CommandInterface 
{
    public function execute(array $request);
}