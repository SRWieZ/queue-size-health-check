<?php

namespace QueueSizeCheck;

use Illuminate\Support\Facades\Queue;
use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;

class QueueSizeCheck extends Check
{
    protected array $queues = [];

    public function queue(string $name, int $max_size, $connection = null): self
    {
        $this->queues[] = [
            'name' => $name,
            'connection' => $connection,
            'max_size' => $max_size,
        ];

        if (!$this->name) {
            $names = array_map(fn ($queue) => $queue['name'], $this->queues);
            $this->name = 'QueueSizeCheck_' . implode('_', $names);
        }

        return $this;
    }

    public function run(): Result
    {
        $queue_to_be_checked = collect($this->queues);

        // Check the default queue
        if ($queue_to_be_checked->isEmpty()) {
            $queue_to_be_checked->push([
                'name' => null,
                'connection' => null,
                'max_size' => 100,
            ]);
        }

        $queue_to_be_checked = $queue_to_be_checked->map(function ($queue) {
            $queue['size'] = $this->getQueueSize($queue['connection'], $queue['name']);

            return $queue;
        });

        $result = Result::make()->meta($queue_to_be_checked->toArray());

        $queue_to_be_checked = $queue_to_be_checked
            ->filter(fn (array $queue) => $queue['size'] > $queue['max_size']);

        if ($queue_to_be_checked->isEmpty()) {
            return $result
                ->ok()
                ->shortSummary('Queues sizes are ok');
        }

        $message = $queue_to_be_checked->count() === 1
            ? 'This queue is'
            : 'These queues are';

        $message .= ' too big: '.$queue_to_be_checked->map(function (array $queue) {
            return '"'.$queue['name'].'" ('.$queue['size'].' greater than '.$queue['max_size'].')';
        })->join(', ', ' and ');

        return $result->failed($message);
    }

    protected function getQueueSize($connection, $name)
    {
        return Queue::connection($connection)->size($name);
    }
}
