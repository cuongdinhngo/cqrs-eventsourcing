<?php

namespace App\Support;

use Illuminate\Support\Facades\Hash;

class Common
{
    /**
     * Hash password
     *
     * @param string $plainPassowrd
     * @return string
     */
    public function hashPassword(string $plainPassowrd): string
    {
        return Hash::make($plainPassowrd);
    }
}
