<?php

use Illuminate\Support\Facades\Notification;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\Enums\Status;
use Spatie\Health\Facades\Health;
use Tests\FakeQueueSizeCheck;

use function Pest\Laravel\artisan;

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
            ->queue('default', 100)
            ->fakeQueueSize(10),
    ]);
}
