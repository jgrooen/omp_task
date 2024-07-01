<?php

namespace App\PaymentChannels;

use App\Models\Entities\Payment;
use App\Models\Entities\PaymentChannel;
use App\Models\Repositories\PaymentChannel\PaymentChannelRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class PaymentChannelManager implements IPaymentChannel
{
    protected array $sortedPaymentChannels = [];

    public function __construct(PaymentChannel $paymentChannel)
    {
        $sortedPaymentChannels = collect();
        $sortedPaymentChannels->push($paymentChannel);

        $paymentChannels = (new PaymentChannelRepository())->getAllActive()->sortBy('priority');
        foreach ($paymentChannels as $_paymentChannel) {
            $sortedPaymentChannels->push($_paymentChannel);
        }

        $this->sortedPaymentChannels = $sortedPaymentChannels->toArray();
    }

    /**
     * @throws Exception
     */
    public function createCharge(Payment $payment)
    {
        /** @var PaymentChannel $_paymentChannel */
        foreach ($this->sortedPaymentChannels as $_paymentChannel) {
            try {
                $className = "App\\PaymentChannels\\Channels\\" . ucfirst($_paymentChannel->getClassName()) . "\\Channel";
                $channel = new $className();

                return $channel->createCharge($payment);
            } catch (Exception $e) {
                Log::error('Payment creation charge failed: ' . $e->getMessage());
            }
        }

        throw new Exception("All payment channels failed.");
    }

    /**
     * @throws Exception
     */
    public function handleWebhook(array $data)
    {
        /** @var PaymentChannel $selectedPaymentChannel */
        $selectedPaymentChannel = $this->sortedPaymentChannels[0];
        $className = "App\\PaymentChannels\\Channels\\" . ucfirst($selectedPaymentChannel->getClassName()) . "\\Channel";
        if (class_exists($className)) {
            $channel = new $className();

            return $channel->handleWebhook($data);
        }

        throw new Exception("Invalid channel name.");
    }
}
