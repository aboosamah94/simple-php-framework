<?php

namespace System\Core;

use PDO;
use PDOException;
use Exception;
use Dotenv\Dotenv;

class Database
{
    private ?PDO $connection = null;
    private bool $isConnected = false;

    /**
     * Database constructor.
     * 
     * @param string $configSource Source of the config ('env' or 'config')
     * @throws Exception if configuration cannot be loaded or connection fails.
     */
    public function __construct(string $configSource = 'env')
    {
        $dbConfig = $this->loadConfig($configSource);

        // If the driver is set to 'none' or config is invalid, skip connection
        if ($dbConfig && strtolower($dbConfig['driver']) !== 'none') {
            $this->connect($dbConfig);
        }
    }

    /**
     * Load database configuration from .env file or config file.
     * 
     * @param string $configSource 'env' or 'config'
     * @return array|null The configuration array or null if not found
     * @throws Exception If the config source is invalid or missing
     */
    private function loadConfig(string $configSource): ?array
    {
        if ($configSource === 'env') {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->safeLoad();  // Use safeLoad to avoid exceptions if .env is missing
            return [
                'driver' => $_ENV['DB_DRIVER'] ?? 'none',
                'host' => $_ENV['DB_HOST'] ?? '',
                'dbname' => $_ENV['DB_NAME'] ?? '',
                'username' => $_ENV['DB_USERNAME'] ?? '',
                'password' => $_ENV['DB_PASSWORD'] ?? '',
            ];
        } elseif ($configSource === 'config') {
            $configPath = APP_PATH . 'Config/Database.php';
            if (file_exists($configPath)) {
                return include($configPath);
            } else {
                throw new Exception("Configuration file 'config.php' not found.");
            }
        }

        throw new Exception("Invalid configuration source: {$configSource}");
    }

    /**
     * Establish a connection to the database using the provided config.
     * 
     * @param array $dbConfig Database configuration
     * @throws Exception If the connection fails
     */
    private function connect(array $dbConfig): void
    {
        try {
            $dsn = $this->getDsn($dbConfig);

            // Create the PDO instance with error handling
            $this->connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->isConnected = true;
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            throw new Exception("Database connection failed: " . $e->getMessage());
        } catch (Exception $e) {
            error_log('Connection setup failed: ' . $e->getMessage());
            throw new Exception("Database connection setup failed: " . $e->getMessage());
        }
    }

    /**
     * Generate the DSN (Data Source Name) based on the database configuration.
     * 
     * @param array $dbConfig Database configuration
     * @return string The DSN for PDO connection
     * @throws Exception If the database driver is unsupported
     */
    private function getDsn(array $dbConfig): string
    {
        switch (strtolower($dbConfig['driver'])) {
            case 'mysql':
                return "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
            case 'pgsql':
                return "pgsql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
            case 'sqlite':
                return "sqlite:{$dbConfig['dbname']}";
            case 'sqlsrv':
                return "sqlsrv:Server={$dbConfig['host']};Database={$dbConfig['dbname']}";
            case 'oci':
                return "oci:dbname={$dbConfig['dbname']}";
            default:
                throw new Exception("Unsupported database driver: {$dbConfig['driver']}");
        }
    }

    /**
     * Get the current PDO connection instance.
     * 
     * @return PDO|null The PDO connection or null if not connected
     */
    public function getConnection(): ?PDO
    {
        return $this->isConnected ? $this->connection : null;
    }

    /**
     * Check if the connection to the database is successful.
     * 
     * @return bool True if connected, false otherwise
     */
    public function isConnected(): bool
    {
        return $this->isConnected;
    }

    /**
     * Close the database connection.
     */
    public function close(): void
    {
        $this->connection = null;
        $this->isConnected = false;
    }
}