<?php

declare(strict_types = 1);

namespace Tests\Unit\Shared\Domain\Entity\Traits\Stub;

use Package\Shared\Domain\Entity\{Entity, Traits\MagicMethodsTrait};

class MagicMethods extends Entity
{
    use MagicMethodsTrait;
}
