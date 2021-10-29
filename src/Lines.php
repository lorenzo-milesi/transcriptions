<?php

namespace LorenzoMilesi\Transcript;

use ArrayIterator;
use Countable;

use IteratorAggregate;

use function array_map;
use function implode;

use const PHP_EOL;

class Lines implements Countable, IteratorAggregate
{
    /**
     * @param  array<Line>  $lines
     */
    public function __construct(protected array $lines) { }

    public function asHtml(): string
    {
        return implode(PHP_EOL, array_map(
                fn(Line $line) => $line->toAnchorTag(),
                $this->lines)
        );
    }

    public function count(): int
    {
        return count($this->lines);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->lines);
    }
}