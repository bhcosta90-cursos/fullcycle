<?php

declare(strict_types = 1);

namespace Package\Application\Validation\Factory;

use Package\Application\Validation\Validate\CategoryValidator;
use Package\Shared\Domain\Validation\ValidatorInterface;

class CategoryValidatorFactory
{
    public static function create(): ValidatorInterface
    {
        return new CategoryValidator();
    }
}
