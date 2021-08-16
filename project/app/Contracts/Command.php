<?php

namespace App\Contracts;

interface Command
{
    /**
     * Execute function
     *
     * @param array $request
     * @return mixed
     */
    public function execute(array $request);
}