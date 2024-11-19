<?php

// Define the minimum PHP version required
const MIN_PHP_VERSION = '8.2';

function ensureCompatiblePHPVersion()
{
    if (version_compare(PHP_VERSION, MIN_PHP_VERSION, '<')) {
        header('HTTP/1.1 503 Service Unavailable', true, 503);
        echo sprintf(
            'Your PHP version must be %s or higher to run this application. Current version: %s',
            MIN_PHP_VERSION,
            PHP_VERSION
        );
        exit(1);
    }
}

ensureCompatiblePHPVersion();

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap
$app = new System\Application();
$app->run();