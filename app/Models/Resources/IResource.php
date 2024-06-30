<?php

namespace App\Models\Resources;

use Eghamat24\DatabaseRepository\Models\Entity\Entity;
use Illuminate\Support\Collection;

interface IResource
{
    public function toArray(Entity $entity): array;

    public function collectionToArray(Collection $entities): array;
}
