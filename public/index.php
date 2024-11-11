<?php

// Minimum PHP version required
$minPhpVersion = '8.2';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    header('HTTP/1.1 503 Service Unavailable', true, 503);
    echo sprintf('Your PHP version must be %s or higher to run this application. Current version: %s', $minPhpVersion, PHP_VERSION);
    exit(1);
}

// Autoload dependencies
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Env;
use App\Core\Router;

// Load environment variables
Env::load();
$appEnv = $_ENV['APP_ENV'] ?? 'production';
$baseURL = rtrim($_ENV['APP_baseURL'] ?? '/', '/');

// Set error reporting based on environment
if ($appEnv === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Define constants for paths
define('BASE_PATH', __DIR__ . '/../');
define('APP_PATH', BASE_PATH . 'app/');
define('PUBLIC_PATH', BASE_PATH . 'public/');

// Helper function for base URL, similar to CodeIgniter's base_url()
function base_url($path = '')
{
    global $baseURL;
    return $baseURL . '/' . ltrim($path, '/');
}

// Initialize Router
$router = new Router();

// Load routes from separate routes file
require APP_PATH . 'Config/Routes.php';

// Get the request URI and normalize it
$requestUri = $_SERVER['REQUEST_URI'];
$normalizedUri = str_replace(parse_url($baseURL, PHP_URL_PATH), '', $requestUri);

// Dispatch the request
$router->dispatch($normalizedUri);
