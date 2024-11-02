<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Entity\CategoryEntity;
use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\DTO\{CategoryCreateInput, CategoryOutput};

class CreateCategoryUseCase
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {
    }

    public function handle(CategoryCreateInput $categoryInput): CategoryOutput
    {
        $entity = new CategoryEntity(
            name: $categoryInput->name,
            description: $categoryInput->description,
            isActive: $categoryInput->is_active,
        );

        /** @var CategoryEntity $newEntity */
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
