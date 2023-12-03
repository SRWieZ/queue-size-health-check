<?php

use Spatie\Health\Enums\Status;
use Tests\FakeQueueSizeCheck;

it('will determine that queue size is ok if it does not cross the maximum', function () {
    $result = FakeQueueSizeCheck::new()
        ->fakeQueueSize('9')
        ->queue('default', '10')
        ->run();

    expect($result->status)
        ->toBe(Status::ok());
});

it('will determine that queue size is not ok if it does cross the maximum', function () {
    $result = FakeQueueSizeCheck::new()
        ->fakeQueueSize('11')
        ->queue('default', '10')
        ->run();

    expect($result->status)->toBe(Status::failed());
});
