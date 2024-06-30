<?php

namespace App\Models\Repositories;

use Illuminate\Cache\CacheManager;

abstract class RedisRepository
{
    private CacheManager $cache;

    public function __construct()
    {
        $this->cache = app('cache');
    }

    /**
     * @return mixed
     */
    protected function getCache(): mixed
    {
        return $this->cache;
    }
}
