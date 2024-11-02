<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Validator;

use Package\Shared\Domain\Entity\Entity;
use Package\Shared\Domain\Validate\LaravelValidate;
use Package\Shared\Domain\Validation\ValidatorInterface;

class CategoryValidator implements ValidatorInterface
{
    public function validate(Entity $entity): void
    {
        $data = $this->convertEntityForArray($entity);

        LaravelValidate::make($entity, $data, [
            'name'        => 'required|min:3|max:100',
            'description' => 'nullable|max:255',
        ]);
    }

    protected function convertEntityForArray(Entity $entity): array
    {
        return [
            'name'        => $entity->name,
            'description' => $entity->description,
        ];
    }
}
