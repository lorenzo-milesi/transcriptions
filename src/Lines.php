<?php

namespace LorenzoMilesi\Transcript;

use Closure;

use function array_map;
use function implode;

use const PHP_EOL;

class Lines extends Collection
{
    public function asHtml(): string
    {
        return $this->map(fn(Line $line) => $line->toHtml());
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->items);
    }
}