<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\DTO\{CategoryOutput};
use Package\Core\UseCase\Category\Exception\CategoryNotFound;

class ShowCategoryUseCase
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {
    }

    public function handle(string $id): CategoryOutput
    {
        $entity = $this->categoryRepository->find($id);

        if ($entity === null) {
            throw new CategoryNotFound($id);
        }

        return new CategoryOutput(
            id: $entity->id(),
            name: $entity->name,
            description: $entity->description,
            is_active: $entity->isActive,
            created_at: $entity->createdAt(),
        );
    }
}
