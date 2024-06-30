<?php

namespace App\Models\Repositories\PaymentChannel;

use App\Models\Entities\PaymentChannel;
use App\Models\Repositories\Redis\SingleKeyCacheStrategy;
use App\Models\Repositories\RedisRepository;
use Illuminate\Support\Collection;

class RedisPaymentChannelRepository extends RedisRepository
{
    use SingleKeyCacheStrategy;

    public function __construct()
    {
        $this->cacheTag = 'payment_channels';
        parent::__construct();
    }

    public function getAll(?int $offset = 0, ?int $count = 0, int &$total = null): Collection
    {
        /** @var Collection $entities */
        $entities = $this->get();

        if ($count) {
            $entities = $entities->splice($offset, $count);
        }

        $total = $entities->count();
        return $entities;
    }

    public function getOneById(int $id): ?PaymentChannel
    {
        return $this->get()->where('id', $id)->first();
    }
}
