<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::env('DB_HOST', 'db') . ';dbname=' . Config::env('DB_NAME', 'videgrenierenligne') . ';charset=utf8';
            $db = new PDO($dsn, Config::env('DB_USER', 'webapplication'), Config::env('DB_PASSWORD', '653rag9T'));
            
            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
