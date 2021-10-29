<?php

namespace LorenzoMilesi\Transcript;

use function preg_match;

class Line
{
    public function __construct(
        public int $position,
        public string $timestamp,
        public string $body,
    )
    {
    }

    public function toAnchorTag(): string
    {
        return "<a href=\"?time={$this->beginningTimestamp()}\">$this->body</a>";
    }

    protected function beginningTimestamp(): string
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }
}