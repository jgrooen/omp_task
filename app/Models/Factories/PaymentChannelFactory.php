<?php

namespace App\Models\Factories;

use App\Models\Entities\PaymentChannel;
use stdClass;

class PaymentChannelFactory extends Factory
{
    public function makeEntityFromStdClass(stdClass $entity): PaymentChannel
    {
        $paymentChannel = new PaymentChannel();

        $paymentChannel->setId($entity->id);
		$paymentChannel->setName($entity->name);
		$paymentChannel->setNameEn($entity->name_en);
		$paymentChannel->setClassName($entity->class_name);
		$paymentChannel->setUrl($entity->url);
		$paymentChannel->setIsActive($entity->is_active);
		$paymentChannel->setPriority($entity->priority);
		$paymentChannel->setSupporterName($entity->supporter_name);
		$paymentChannel->setSupporterPhone($entity->supporter_phone);
		$paymentChannel->setSupporterEmail($entity->supporter_email);
		$paymentChannel->setDescription($entity->description);
		$paymentChannel->setCreatedAt($entity->created_at);
		$paymentChannel->setUpdatedAt($entity->updated_at);

        return $paymentChannel;
    }
}
