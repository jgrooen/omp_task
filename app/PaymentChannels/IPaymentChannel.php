<?php

namespace App\PaymentChannels;

use App\Models\Entities\Payment;
use App\Models\Entities\PaymentChannel;

interface IPaymentChannel
{
    public function __construct(PaymentChannel $paymentChannel);

    public function createCharge(Payment $payment);

    public function handleWebhook(array $data);
}
