<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Entity\Traits;

use Closure;
use Package\Shared\Domain\Notification\{Notification, NotificationException};
use Package\Shared\Domain\Validation\ValidatorInterface;

trait ValidatorTrait
{
    protected static ?Closure $validatorFactory = null;

    protected ?Notification $notification = null;

    public static function setValidatorFactory(?callable $factory): void
    {
        self::$validatorFactory = $factory;
    }

    protected function validate(): void
    {
        $validator = self::$validatorFactory ? (self::$validatorFactory)() : $this->getValidator();

        $validator->validate($this);

        if ($this->notification()->hasErrors()) {
            throw new NotificationException(
                $this->notification()->messages(
                    $this->getValidator()
                        ? get_class($this->getValidator())
                        : null
                )
            );
        }
    }

    abstract protected function getValidator(): ?ValidatorInterface;

    public function notification(): Notification
    {
        if ($this->notification === null) {
            $this->notification = new Notification();
        }

        return $this->notification;
    }
}
