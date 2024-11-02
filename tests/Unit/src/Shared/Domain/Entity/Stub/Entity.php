<?php

declare(strict_types = 1);

namespace Tests\Unit\src\Shared\Domain\Entity\Stub;

use Package\Shared\Domain\Entity\{Entity as EntityAbstract, Traits\MagicMethodsTrait};

class Entity extends EntityAbstract
{
    use MagicMethodsTrait;

    public function __construct(
        protected ?string $name = null,
        protected ?string $description = null,
        protected bool $isActive = true
    ) {
        //
    }
}
