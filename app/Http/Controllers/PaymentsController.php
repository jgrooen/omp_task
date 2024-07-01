<?php

namespace App\Http\Controllers;

use App\Models\Entities\Payment;
use App\Models\Entities\PaymentChannel;
use App\Models\Repositories\PaymentChannel\PaymentChannelRepository;
use App\PaymentChannels\PaymentChannelManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'mobile' => 'nullable|string',
            'payment_channel_id' => 'required|int',
        ]);

        $payment = new Payment();
        $payment->setAmount($request->input('amount'));
        $payment->setCurrency($request->input('currency'));
        $payment->setMobile($request->input('mobile'));

        $selectedPaymentChannel = (new PaymentChannelRepository())->getOneById($request->input('payment_channel_id'));

        $paymentChannelManager = new PaymentChannelManager($selectedPaymentChannel);

        try {
            $result = $paymentChannelManager->createCharge($payment);

            return response()->json(['success' => true, 'data' => $result], 200);
        } catch (\Exception $e) {
            Log::error('Payment creation failed: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function handleWebhook(string $paymentChannelName, Request $request): JsonResponse
    {
        $selectedPaymentChannel = (new PaymentChannelRepository())->getOneByNameEn($request->input('payment_channel_id'));
        $paymentChannelManager = new PaymentChannelManager($selectedPaymentChannel);

        try {
            $paymentChannelManager->handleWebhook($request->all());

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            Log::error('Webhook handling failed: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
