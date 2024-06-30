<?php

namespace App\Models\Resources;

use Eghamat24\DatabaseRepository\Models\Entity\Entity;
use Illuminate\Support\Collection;

abstract class Resource implements IResource
{
    abstract public function toArray(Entity $entity): array;

    public function collectionToArray(Collection $entities): array
    {
        $entityArray = [];

        foreach ($entities as $_entity) {
            $entityArray[] = $this->toArray($_entity);
        }

        return $entityArray;
    }
}
