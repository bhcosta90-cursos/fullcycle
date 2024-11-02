<?php

declare(strict_types = 1);

namespace Tests;

use Package\Shared\Domain\Entity\Entity;
use Package\Shared\Domain\Validation\ValidatorInterface;

abstract class UnitCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $mock = \Mockery::mock(ValidatorInterface::class);
        $mock->shouldReceive('validate')->andReturn([]);

        Entity::setValidatorFactory(fn () => $mock);

    }

    protected function tearDown(): void
    {
        Entity::setValidatorFactory(null);
        \Mockery::close();
        parent::tearDown();
    }
}
