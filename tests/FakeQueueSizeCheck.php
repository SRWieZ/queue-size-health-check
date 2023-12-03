<?php

namespace Tests;

use QueueSizeCheck\QueueSizeCheck;

class FakeQueueSizeCheck extends QueueSizeCheck
{
    protected int $fake_size = 0;

    public function fakeQueueSize(int $fake_size): self
    {
        $this->fake_size = $fake_size;

        return $this;
    }

    protected function getQueueSize($connection, $name): int
    {
        return $this->fake_size;
    }
}
