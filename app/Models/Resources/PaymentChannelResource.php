<?php

namespace App\Models\Resources;

use App\Models\Entities\PaymentChannel;
use Eghamat24\DatabaseRepository\Models\Entity\Entity;
use Eghamat24\DatabaseRepository\Models\Resources\Resource;

class PaymentChannelResource extends Resource
{
    public function toArray($entity): array
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'name_en' => $entity->getNameEn(),
            'class_name' => $entity->getClassName(),
            'url' => $entity->getUrl(),
            'is_active' => $entity->getIsActive(),
            'priority' => $entity->getPriority(),
            'supporter_name' => $entity->getSupporterName(),
            'supporter_phone' => $entity->getSupporterPhone(),
            'supporter_email' => $entity->getSupporterEmail(),
            'description' => $entity->getDescription(),
            'created_at' => $entity->getCreatedAt(),
            'updated_at' => $entity->getUpdatedAt(),
        ];
    }

    public function toArrayWithForeignKeys(Entity|PaymentChannel $paymentChannel): array
    {
        return $this->toArray($paymentChannel) + [

            ];
    }
}
