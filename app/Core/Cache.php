<?php
namespace App\Core;

use App\Config\Cache as CacheConfig;

class Cache
{
    private string $cachePath;
    private int $defaultTTL;

    public function __construct()
    {
        $config = new CacheConfig();

        $this->cachePath = $config->storePath;
        $this->defaultTTL = $config->ttl;

        $this->ensureCacheDirectory();
    }

    private function ensureCacheDirectory()
    {
        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0775, true);
        }
    }

    public function get($key)
    {
        $filePath = $this->cachePath . md5($key);

        if (!file_exists($filePath)) {
            return false;
        }

        $cacheData = unserialize(file_get_contents($filePath));

        if (time() > $cacheData['expires']) {
            unlink($filePath);
            return false;
        }

        return $cacheData['data'];
    }

    public function save($key, $data, $ttl = null)
    {
        $ttl = $ttl ?? $this->defaultTTL;
        $filePath = $this->cachePath . md5($key);

        $cacheData = [
            'data' => $data,
            'expires' => time() + $ttl,
        ];

        return file_put_contents($filePath, serialize($cacheData)) !== false;
    }

    public function delete($key)
    {
        $filePath = $this->cachePath . md5($key);

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function clear()
    {
        $files = glob($this->cachePath . '*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
