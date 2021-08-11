<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

if (!function_exists('generateApiToken')) {
	/**
	 * Get current locale
	 * 
	 * @return string
	 */
	function generateApiToken(int $length = null)
	{
        return Str::random($length ?? config('api_token_length'));
	}
}

if (!function_exists('checkPassword')) {
	/**
	 * Check plain and hashed password
	 *
	 * @param string $plainPassword
	 * @param string $hashedPassword
	 * @return boolean
	 */
	function checkPassword(string $plainPassword, string $hashedPassword)
	{
        return Hash::check($plainPassword, $hashedPassword);
	}
}