<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Entity;

use Package\Shared\Domain\Entity\Traits\{MagicMethodsTrait, ValidatorTrait};
use Package\Shared\Domain\ValueObject\Id;

abstract class Entity
{
    use MagicMethodsTrait;
    use ValidatorTrait;

    public static function make(...$data): self
    {
        if (is_array($data[0] ?? null)) {
            $data = $data[0];
        }

        $id        = $data['id'] ?? null;
        $createdAt = $data['createdAt'] ?? $data['created_at'] ?? null;

        unset($data['id'], $data['createdAt'], $data['created_at']);

        $data      = self::transformKeys($data);
        $newEntity = new static(...$data);

        if ($id) {
            $newEntity->id = $id instanceof Id ? $id : new Id($id);
        }

        if ($createdAt) {
            $newEntity->createdAt = $createdAt instanceof \DateTime ? $createdAt : new \DateTime($createdAt);
        }

        return $newEntity;
    }

    public function update(...$data): void
    {
        if (is_array($data[0] ?? null)) {
            $data = $data[0];
        }

        if (!property_exists(static::class, 'fillable')) {
            return;
        }

        $data = self::transformKeys($data);

        foreach ($data as $key => $value) {
            if (in_array($key, $this->fillable, true)) {
                $this->{$key} = $value;
            }
        }

        $this->validate();
    }

    private static function transformString(string $input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    private static function transformKeys(array $data): array
    {
        foreach ($data as $key => $value) {

            if (!property_exists(static::class, $key)) {
                $keyCamelCase = self::transformString($key);

                unset($data[$key]);

                if (!property_exists(static::class, $keyCamelCase)) {
                    continue;
                }

                $data[$keyCamelCase] = $value;
            }
        }

        return $data;
    }
}
