<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Entity\CategoryEntity;
use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\DTO\{CategoryOutput, CategoryUpdateInput};
use Package\Core\UseCase\Category\Exception\CategoryNotFoundException;

class UpdateCategoryUseCase
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {
    }

    public function handle(CategoryUpdateInput $input): CategoryOutput
    {
        /** @var CategoryEntity $entity */
        $entity = $this->categoryRepository->find($input->id);

        if ($entity === null) {
            throw new CategoryNotFoundException($input->id);
        }

        $entity->update(name: $input->name, description: $input->description);

        if ($input->is_active !== $entity->isActive) {
            $input->is_active
                ? $entity->enable()
                : $entity->disable();
        }

        $this->categoryRepository->update($entity);

        return new CategoryOutput(
            id: $entity->id(),
            name: $entity->name,
            description: $entity->description,
            is_active: $entity->isActive,
            created_at: $entity->createdAt(),
        );
    }
}