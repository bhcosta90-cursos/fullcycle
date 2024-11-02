<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Validation;

use Package\Shared\Domain\Entity\Entity;

interface ValidatorInterface
{
    public function validate(Entity $entity): void;
}
