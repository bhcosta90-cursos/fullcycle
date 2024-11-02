<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Factory;

use Package\Core\Domain\Validator\CategoryValidator;
use Package\Shared\Domain\Validation\ValidatorInterface;

class CategoryValidatorFactory
{
    public static function create(): ValidatorInterface
    {
        return new CategoryValidator();
    }
}
