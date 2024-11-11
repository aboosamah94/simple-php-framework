<?php
namespace App\Core;

use Dotenv\Dotenv;

class Env
{
    // Method to load environment variables from the .env file
    public static function load()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');  // Loads .env from the project root
        $dotenv->load();  // Loads variables into the environment
    }
}
