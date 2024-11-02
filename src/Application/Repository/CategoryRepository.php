<?php

declare(strict_types = 1);

namespace Package\Application\Repository;

use App\Models\Category;
use Package\Core\Domain\Entity\CategoryEntity;
use Package\Core\Domain\Repository\CategoryRepositoryInterface;
use Package\Shared\Domain\Entity\Entity;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(protected Category $category)
    {
    }

    public function create(Entity $categoryEntity): CategoryEntity
    {
        $dbCategory = $this->category->create([
            'name'        => $categoryEntity->name,
            'description' => $categoryEntity->description,
            'is_active'   => $categoryEntity->isActive,
        ]);

        return $this->toEntity($dbCategory);
    }

    public function update(Entity $categoryEntity): CategoryEntity
    {
        $dbCategory = $this->getModel($categoryEntity->id());
        $dbCategory->update([
            'name'        => $categoryEntity->name,
            'description' => $categoryEntity->description,
            'is_active'   => $categoryEntity->isActive,
        ]);

        return $this->toEntity($dbCategory);
    }

    public function find(string $id): ?CategoryEntity
    {
        return $this->toEntity($this->getModel($id));
    }

    public function delete(string $id): bool
    {
        return (bool) $this->getModel($id)?->delete();
    }

    protected function getModel(string $id): Category
    {
        return $this->category->find($id);
    }

    protected function toEntity(object $data): CategoryEntity
    {
        return CategoryEntity::make($data->toArray());
    }
}
