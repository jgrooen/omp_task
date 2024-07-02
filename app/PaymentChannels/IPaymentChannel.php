<?php

namespace App\PaymentChannels;

use App\Models\Entities\Payment;
use App\Models\Entities\PaymentChannel;

interface IPaymentChannel
{
    public function __construct(PaymentChannel $paymentChannel);

    public function createPayment(Payment $payment);

    public function verify(array $data);
}
