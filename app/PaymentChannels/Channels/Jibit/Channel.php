<?php

namespace App\PaymentChannels\Channels\Jibit;

use App\Models\Entities\Payment;
use App\Models\Entities\PaymentChannel;
use App\PaymentChannels\IPaymentChannel;

class Channel implements IPaymentChannel
{
    private PaymentChannel $entityChannel;
    private Api $api;

    public function __construct(PaymentChannel $entityChannel)
    {
        $this->entityChannel = $entityChannel;
        $this->api = new Api();
    }

    public function createPayment(Payment $payment)
    {
        // TODO: Implement createCharge() method.
    }

    public function verify(array $data)
    {
        // TODO: Implement handleWebhook() method.
    }
}
