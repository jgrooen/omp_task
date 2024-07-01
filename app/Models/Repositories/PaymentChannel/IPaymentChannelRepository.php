<?php

namespace App\Models\Repositories\PaymentChannel;

use App\Models\Entities\PaymentChannel;
use Illuminate\Support\Collection;

interface IPaymentChannelRepository
{
    public function getOneById(int $id): null|PaymentChannel;

    public function getAllActive(): Collection;

    public function create(PaymentChannel $paymentChannel): PaymentChannel;

    public function update(PaymentChannel $paymentChannel): int;
}
