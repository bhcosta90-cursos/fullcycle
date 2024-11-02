<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Entity\CategoryEntity;
use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\DTO\CategoryOutput;

class CreateCategoryUseCase
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {
    }

    public function handle(string $name, ?string $description = null): CategoryOutput
    {
        $entity = new CategoryEntity(
            name: $name,
            description: $description,
        );

        $newEntity = $this->categoryRepository->create($entity);

        return new CategoryOutput(
            id: $newEntity->id(),
            name: $newEntity->name,
            description: $newEntity->description,
            is_active: $newEntity->isActive,
            created_at: $newEntity->createdAt(),
        );
    }
}
