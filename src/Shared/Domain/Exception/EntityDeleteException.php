<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Exception;

use Exception;
use Throwable;

class EntityDeleteException extends Exception
{
    public function __construct(string $entity, string $id, int $code = 404, ?Throwable $previous = null)
    {
        $message = sprintf('%s cannot deleted with id: %s', $entity, $id);

        parent::__construct($message, $code, $previous);
    }
}
