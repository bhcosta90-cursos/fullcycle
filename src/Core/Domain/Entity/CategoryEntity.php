<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Entity;

use Package\Core\Domain\Factory\CategoryValidatorFactory;
use Package\Shared\Domain\Entity\Entity;
use Package\Shared\Domain\Validation\ValidatorInterface;

class CategoryEntity extends Entity
{
    public function __construct(
        protected string $name,
        protected ?string $description = null,
        protected bool $isActive = true,
    ) {
        $this->validate();
    }

    protected array $fillable = ['name', 'description'];

    public function enable(): void
    {
        $this->isActive = true;
    }

    public function disable(): void
    {
        $this->isActive = false;
    }

    protected function getValidator(): ValidatorInterface
    {
        return CategoryValidatorFactory::create();
    }
}
