<?php

namespace System;

use System\Core\Env;
use System\Core\Router;

class Application
{
    public function __construct()
    {
        // Initialize environment settings
        Env::load();

        // Set up error reporting
        $this->configureErrorReporting();

        // Define constants for paths
        $this->definePaths();
    }

    public function run()
    {
        // Initialize Router
        $router = new Router();
        require APP_PATH . 'Config/Routes.php';
        $this->dispatchRequest($router);
    }

    private function configureErrorReporting()
    {
        $appEnv = $_ENV['APP_ENV'] ?? 'production';

        if ($appEnv === 'development') {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        } else {
            error_reporting(0);
            ini_set('display_errors', '0');
        }
    }

    private function definePaths()
    {
        define('BASE_PATH', __DIR__ . '/../');
        define('APP_PATH', BASE_PATH . 'app/');
        define('WRITE_PATH', BASE_PATH . 'writable/');
        define('PUBLIC_PATH', BASE_PATH . 'public/');
    }

    private function dispatchRequest(Router $router)
    {
        $baseURL = rtrim($_ENV['APP_baseURL'] ?? '/', '/');
        $requestUri = $_SERVER['REQUEST_URI'];
        $normalizedUri = str_replace(parse_url($baseURL, PHP_URL_PATH), '', $requestUri);

        // Dispatch the request
        $router->dispatch($normalizedUri);
    }
}