<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Validate;

use Illuminate\Support\Facades\Validator;
use Package\Shared\Domain\Entity\Entity;

class LaravelValidate
{
    public static function make(Entity $entity, array $data, array $rules): void
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            foreach ($validator->errors()->messages() as $error) {
                $entity->notification()->addError([
                    'context' => get_class($entity),
                    'message' => $error[0],
                ]);
            }
        }
    }
}
