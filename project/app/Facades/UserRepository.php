<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Contracts\User as UserContract;

class UserRepository extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UserContract::class;
    }
}