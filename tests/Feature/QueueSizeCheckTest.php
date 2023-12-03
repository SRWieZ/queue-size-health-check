<?php

use Illuminate\Support\Facades\Notification;
use QueueSizeCheck\QueueSizeCheck;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\Enums\Status;
use Spatie\Health\Facades\Health;
use Tests\FakeQueueSizeCheck;

use function Pest\Laravel\artisan;

it('will determine that queue size is ok if it does not cross the maximum', function () {
    $result = QueueSizeCheck::new()
        ->queue('default', '9')
        ->run();

    expect($result->status)
        ->toBe(Status::ok());
});

it('will determine that queue size is not ok if it does cross the maximum', function () {
    $result = QueueSizeCheck::new()
        ->queue('default', '11')
        ->run();

    expect($result->status)->toBe(Status::failed());
});

it('should not send a notification on a successful check', function () {
    Notification::fake();

    registerPassingQueueSizeCheck();

    artisan(RunHealthChecksCommand::class)->assertSuccessful();

    Notification::assertNothingSent();
});

function registerPassingQueueSizeCheck()
{
    Health::checks([
        FakeQueueSizeCheck::new()
            ->fakeQueueSize(10),
    ]);
}
