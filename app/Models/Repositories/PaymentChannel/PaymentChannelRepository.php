<?php

namespace App\Models\Repositories\PaymentChannel;

use App\Models\Entities\PaymentChannel;
use Illuminate\Support\Collection;

class PaymentChannelRepository implements IPaymentChannelRepository
{
    private MySqlPaymentChannelRepository $mysqlRepository;
    private RedisPaymentChannelRepository $redisRepository;

    public function __construct()
    {
        $this->mysqlRepository = new MySqlPaymentChannelRepository();
        $this->redisRepository = new RedisPaymentChannelRepository();
    }

    public function getAllActive(): Collection
    {
        if (!$this->redisRepository->has()) {
            $entities = $this->mysqlRepository->getAllActive();
            $this->redisRepository->put($entities);

            return $entities;
        } else {
            return $this->redisRepository->getAllActive();
        }
    }

    public function getOneById(int $id): null|PaymentChannel
    {
        if (!$this->redisRepository->has()) {
            $entities = $this->mysqlRepository->getAllActive();
            $this->redisRepository->put($entities);
        }

        return $this->redisRepository->getOneById($id);
    }

    public function getOneByNameEn(string $nameEn): null|PaymentChannel
    {
        return $this->mysqlRepository->getOneByNameEn($nameEn);
    }

    public function create(PaymentChannel $paymentChannel): PaymentChannel
    {
        $this->redisRepository->clear();

        return $this->mysqlRepository->create($paymentChannel);
    }

    public function update(PaymentChannel $paymentChannel): int
    {
        $this->redisRepository->clear();

        return $this->mysqlRepository->update($paymentChannel);
    }
}
