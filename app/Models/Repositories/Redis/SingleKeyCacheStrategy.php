<?php

namespace App\Models\Repositories\Redis;

use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait SingleKeyCacheStrategy
{
    /** @var string $cacheKey */
    private string $cacheKey = '';

    /**
     * @return bool
     */
    public function has(): bool
    {
        return $this->getCache()->has($this->cacheKey);
    }

    /**
     * @param array|Collection $entities
     */
    public function put(array|Collection $entities): void
    {
        $this->getCache()->forever($this->cacheKey, $entities);
    }

    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function get(): mixed
    {
        return $this->getCache()->get($this->cacheKey);
    }

    /**
     * @return bool
     */
    public function clear(): bool
    {
        return $this->getCache()->forget($this->cacheKey);
    }
}
