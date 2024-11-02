<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Validator;

use Illuminate\Support\Facades\Validator;
use Package\Shared\Domain\Entity\Entity;
use Package\Shared\Domain\Validation\ValidatorInterface;

class CategoryValidator implements ValidatorInterface
{
    public function validate(Entity $entity): void
    {
        $data = $this->convertEntityForArray($entity);

        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $error) {
                $entity->notification->addError([
                    'context' => 'video',
                    'message' => $error[0],
                ]);
            }
        }
    }

    private function convertEntityForArray(Entity $entity): array
    {
        return [
            'name' => $entity->name,
        ];
    }
}
