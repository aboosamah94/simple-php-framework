<?php

namespace System\Core;

use Dotenv\Dotenv;
use Exception;

class Env
{
    /**
     * Loads environment variables from the .env file.
     *
     * @param string $path Path to the directory containing the .env file. Defaults to the project's root.
     * @throws Exception If the .env file cannot be loaded.
     */
    public static function load(string $path = __DIR__ . '/../../'): void
    {
        try {
            $dotenv = Dotenv::createImmutable($path);
            $dotenv->load();
        } catch (Exception $e) {
            // Handle .env loading error, log it or throw exception
            error_log("Error loading .env file: " . $e->getMessage());
            throw new Exception("Unable to load the .env file: " . $e->getMessage());
        }
    }

    /**
     * Retrieves an environment variable's value.
     *
     * @param string $key The environment variable key.
     * @param mixed $default The default value to return if the key is not set.
     * @return mixed The value of the environment variable, or the default value.
     */
    public static function get(string $key, $default = null)
    {
        // Check if the environment variable exists and return it, otherwise return the default
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }

    /**
     * Retrieves all environment variables as an associative array.
     *
     * @return array All environment variables.
     */
    public static function getAll(): array
    {
        return $_ENV;
    }

    /**
     * Checks if an environment variable exists.
     *
     * @param string $key The environment variable key.
     * @return bool True if the variable exists, false otherwise.
     */
    public static function has(string $key): bool
    {
        return isset($_ENV[$key]) || getenv($key) !== false;
    }
}