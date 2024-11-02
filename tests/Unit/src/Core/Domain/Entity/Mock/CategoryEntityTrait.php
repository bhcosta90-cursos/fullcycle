<?php

declare(strict_types = 1);

namespace Tests\Unit\src\Core\Domain\Entity\Mock;

use Package\Core\Domain\Entity\CategoryEntity;

trait CategoryEntityTrait
{
    public function makeCategoryEntity(array $data = [])
    {
        $data += [
            'name' => 'Category Name',
        ];

        return new CategoryEntity(...$data);

    }
}
