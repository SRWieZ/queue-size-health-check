<?php
use Illuminate\Support\Facades\Queue;
use Tests\FakeJob;

test('multiple jobs are added to the queue', function () {
    Queue::fake();
    
    for ($i = 0; $i < 10; $i++) {
        FakeJob::dispatch('data' . $i);
    }
    
    Queue::assertPushed(FakeJob::class, 10);
});
