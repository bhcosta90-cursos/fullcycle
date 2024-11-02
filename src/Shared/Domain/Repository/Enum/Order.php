<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Repository\Enum;

enum Order: string
{
    case ASC  = 'asc';
    case DESC = 'desc';
}
