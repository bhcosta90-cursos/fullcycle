<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Entity\Traits;

use DateTime;
use DateTimeInterface;
use Exception;
use Package\Shared\Domain\ValueObject\Id;

trait MagicMethodsTrait
{
    protected ?Id $id = null;

    protected ?DateTimeInterface $createdAt = null;

    public function __get($property)
    {
        if ($property === 'id' && empty($this->{$property})) {
            return $this->id = Id::random();
        }

        if ($property === 'createdAt' && empty($this->{$property})) {
            return $this->createdAt = new DateTime();
        }

        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        $className = get_class($this);

        throw new Exception("Property {$property} not found in class {$className}");
    }

    public function id(): string
    {
        return (string)($this->id ?: Id::random());
    }

    public function createdAt(): string
    {
        return $this->createdAt?->format('Y-m-d H:i:s') ?: (new DateTime())->format('Y-m-d H:i:s');
    }
}
