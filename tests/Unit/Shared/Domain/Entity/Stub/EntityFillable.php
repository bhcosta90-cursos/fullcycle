<?php

declare(strict_types = 1);

namespace Tests\Unit\Shared\Domain\Entity\Stub;

class EntityFillable extends Entity
{
    protected array $fillable = ['name', 'description'];
}
