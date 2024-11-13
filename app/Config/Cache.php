<?php
namespace App\Config;

class Cache
{
    public string $storePath = WRITE_PATH . 'cache/';  // Default cache storage path
    public int $ttl = 3600; // Default time-to-live for cache in seconds
}