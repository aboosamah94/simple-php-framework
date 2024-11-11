<?php
namespace App\Core;

use PDO;
use PDOException;
use Exception;
use Dotenv\Dotenv;

class Database
{
    private $connection;
    private $isConnected = false;

    public function __construct($configSource = 'env')
    {
        $dbConfig = $this->loadConfig($configSource);

        // If the driver is set to 'none' or config is invalid, skip connection
        if ($dbConfig && strtolower($dbConfig['driver']) !== 'none') {
            $this->connect($dbConfig);
        }
    }

    private function loadConfig($configSource)
    {
        if ($configSource === 'env') {
            // Load from .env file
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
            // Load from config.php file
            $configPath = APP_PATH . 'Config/Database.php';
            if (file_exists($configPath)) {
                $config = include($configPath);
                return $config;
            } else {
                throw new Exception("Configuration file config.php not found.");
            }
        }
        return null;
    }

    private function connect($dbConfig)
    {
        try {
            switch (strtolower($dbConfig['driver'])) {
                case 'mysql':
                    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
                    break;
                case 'pgsql':
                    $dsn = "pgsql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
                    break;
                case 'sqlite':
                    $dsn = "sqlite:{$dbConfig['dbname']}";
                    break;
                case 'sqlsrv':
                    $dsn = "sqlsrv:Server={$dbConfig['host']};Database={$dbConfig['dbname']}";
                    break;
                case 'oci':
                    $dsn = "oci:dbname={$dbConfig['dbname']}";
                    break;
                default:
                    throw new Exception("Unsupported database driver: {$dbConfig['driver']}");
            }

            $this->connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->isConnected = true;

        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());  // Log error instead of echoing
            $this->connection = null;
        } catch (Exception $e) {
            error_log('Connection setup failed: ' . $e->getMessage());
            $this->connection = null;
        }
    }

    public function getConnection()
    {
        return $this->isConnected ? $this->connection : null;
    }

    public function isConnected()
    {
        return $this->isConnected;
    }
}