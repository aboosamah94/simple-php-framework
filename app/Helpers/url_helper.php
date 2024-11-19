<?php

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $baseURL = $_ENV['APP_baseURL'] ?? null;

        if (!$baseURL) {
            $config = require APP_PATH . 'Config/App.php';
            $baseURL = $config->baseURL;
        }

        // Ensure the base URL has no trailing slash and append the path
        return rtrim($baseURL, '/') . '/' . ltrim($path, '/');
    }
}
