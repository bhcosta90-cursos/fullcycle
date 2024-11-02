<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Entity\CategoryEntity;
use Package\Core\Domain\Repository\CategoryRepositoryInterface;
use Package\Core\UseCase\Category\DTO\{CategoryOutput};

class ShowCategoryUseCase
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function handle(string $id): CategoryOutput
    {
        /** @var CategoryEntity $entity */
        $entity = $this->categoryRepository->find($id);

        return new CategoryOutput(
            id: $entity->id(),
            name: $entity->name,
            description: $entity->description,
            is_active: $entity->isActive,
            created_at: $entity->createdAt(),
        );
    }
}
