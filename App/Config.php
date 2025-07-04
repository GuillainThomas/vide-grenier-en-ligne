<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */

class Config
{
    /**
     * Retrieve an environment variable or fallback to the provided default.
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function env(string $key, string $default): string
    {
        $value = getenv($key);
        return ($value === false || $value === '') ? $default : $value;
    }

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
}
