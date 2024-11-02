<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\Exception\{CategoryDeleteException};

class DeleteCategoryUseCase
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {
    }

    public function handle(string $id): bool
    {
        $response = $this->categoryRepository->delete($id);

        if (!$response) {
            throw new CategoryDeleteException($id);
        }

        return true;
    }
}
