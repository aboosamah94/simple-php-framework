<?php
namespace App\Config;

return [
    'cache_path' => realpath(WRITE_PATH . 'cache/') . DIRECTORY_SEPARATOR,
    'cache_ttl' => 3600, // Cache time in seconds
];
