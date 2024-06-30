<?php

namespace App\Models\Factories;

use Eghamat24\DatabaseRepository\Models\Entity\Entity;
use Eghamat24\DatabaseRepository\Models\Factories\IFactory;
use Illuminate\Support\Collection;
use stdClass;

abstract class Factory implements IFactory
{
    abstract public function makeEntityFromStdClass(stdClass $entity): Entity;

    public function makeCollectionOfEntities(Collection|array $entities): Collection
    {
        $entityCollection = collect();

        foreach ($entities as $_entity) {
            if (is_array($_entity)) {
                $_entity = (object)$_entity;
            }
            $entityCollection->push($this->makeEntityFromStdClass($_entity));
        }

        return $entityCollection;
    }
}
