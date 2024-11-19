<?php

namespace System\Core;

use App\Config\Cache as CacheConfig;
use Exception;

class Cache
{
    private string $cachePath;
    private int $defaultTTL;

    /**
     * Cache constructor.
     *
     * @param CacheConfig $config Cache configuration (injected for better testability)
     */
    public function __construct(CacheConfig $config = null)
    {
        // Use provided config or fall back to a new instance
        $config = $config ?? new CacheConfig();

        $this->cachePath = $config->storePath;
        $this->defaultTTL = $config->ttl;

        // Ensure the cache directory exists
        $this->ensureCacheDirectory();
    }

    /**
     * Ensure the cache directory exists. Create it if it doesn't.
     */
    private function ensureCacheDirectory(): void
    {
        if (!is_dir($this->cachePath)) {
            if (!mkdir($this->cachePath, 0775, true)) {
                throw new Exception("Unable to create cache directory at {$this->cachePath}");
            }
        }
    }

    /**
     * Retrieve data from cache.
     *
     * @param string $key Cache key.
     * @return mixed Cached data or false if cache is expired or not found.
     */
    public function get(string $key)
    {
        $filePath = $this->cachePath . md5($key);

        // Check if cache file exists
        if (!file_exists($filePath)) {
            return false;
        }

        // Read and unserialize cached data
        $cacheData = unserialize(file_get_contents($filePath));

        // Check if cache is expired
        if (time() > $cacheData['expires']) {
            unlink($filePath); // Delete expired cache
            return false;
        }

        return $cacheData['data'];
    }

    /**
     * Save data to cache.
     *
     * @param string $key Cache key.
     * @param mixed $data Data to cache.
     * @param int|null $ttl Time-to-live in seconds (null will use default TTL).
     * @return bool True on success, false on failure.
     */
    public function save(string $key, $data, int $ttl = null): bool
    {
        $ttl = $ttl ?? $this->defaultTTL;
        $filePath = $this->cachePath . md5($key);

        // Prepare data for caching
        $cacheData = [
            'data' => $data,
            'expires' => time() + $ttl,
        ];

        // Write serialized cache data to the file
        return file_put_contents($filePath, serialize($cacheData)) !== false;
    }

    /**
     * Delete a cache file by its key.
     *
     * @param string $key Cache key.
     */
    public function delete(string $key): void
    {
        $filePath = $this->cachePath . md5($key);

        if (file_exists($filePath)) {
            unlink($filePath); // Delete the cache file
        }
    }

    /**
     * Clear all cache files in the cache directory.
     */
    public function clear(): void
    {
        $files = glob($this->cachePath . '*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete each cache file
            }
        }
    }
}
