<?php

namespace App\Models\Repositories\PaymentChannel;

use App\Models\Entities\PaymentChannel;
use Illuminate\Support\Collection;

interface IPaymentChannelRepository
{
    public function getOneById(int $id): null|PaymentChannel;

    public function getAll(?int $offset = 0, ?int $count = 0, int &$total = null): Collection;

    public function create(PaymentChannel $paymentChannel): PaymentChannel;

    public function update(PaymentChannel $paymentChannel): int;
}
