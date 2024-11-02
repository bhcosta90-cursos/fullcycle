<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Repository;

use Package\Shared\Domain\Entity\Entity;

interface EntityInterface
{
    public function create(Entity $categoryEntity): Entity;

    public function update(Entity $categoryEntity): Entity;

    public function find(string $id): ?Entity;

    public function delete(string $id): bool;
}
