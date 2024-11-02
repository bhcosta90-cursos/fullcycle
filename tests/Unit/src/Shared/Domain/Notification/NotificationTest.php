<?php

declare(strict_types = 1);

use Package\Shared\Domain\Notification\Notification;

it('can add an error', function () {
    $notification = new Notification();
    $error        = ['context' => 'TestContext', 'message' => 'Test error message'];

    $notification->addError($error);

    expect($notification->getErrors())->toHaveCount(1);
    expect($notification->getErrors()[0])->toBe($error);
});

it('can check if there are errors', function () {
    $notification = new Notification();
    expect($notification->hasErrors())->toBeFalse();

    $notification->addError(['context' => 'TestContext', 'message' => 'Test error message']);
    expect($notification->hasErrors())->toBeTrue();
});

it('can retrieve error messages', function () {
    $notification = new Notification();
    $notification->addError(['context' => 'TestContext', 'message' => 'Test error message']);
    $notification->addError(['context' => 'AnotherContext', 'message' => 'Another error message']);

    expect($notification->messages())->toBe('TestContext: Test error message,AnotherContext: Another error message,');
    expect($notification->messages('TestContext'))->toBe('TestContext: Test error message,');
});
