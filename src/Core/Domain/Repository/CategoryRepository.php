<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Repository;

use Package\Core\Domain\Entity\CategoryEntity;

interface CategoryRepository
{
    public function create(CategoryEntity $categoryEntity): CategoryEntity;

    public function update(CategoryEntity $categoryEntity): CategoryEntity;

    public function find(string $id): ?CategoryEntity;
}
