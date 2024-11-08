<?php

declare(strict_types = 1);

namespace Tests\Unit\src\Shared\Domain\Entity\Traits\Stub;

use Package\Shared\Domain\Entity\{Entity, Traits\MagicMethodsTrait};
use Package\Shared\Domain\Validation\ValidatorInterface;

class MagicMethods extends Entity
{
    use MagicMethodsTrait;

    protected function getValidator(): ?ValidatorInterface
    {
        return null;
    }
}
