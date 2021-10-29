<?php

namespace LorenzoMilesi\Transcript;

use ArrayAccess;
use ArrayIterator;
use Countable;

use IteratorAggregate;

use function array_map;
use function implode;

use function is_null;
use function PHPUnit\Framework\isNull;

use const PHP_EOL;

class Lines implements Countable, IteratorAggregate, ArrayAccess
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

    public function offsetExists($offset): bool
    {
        return isset($this->lines[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->lines[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if(is_null($offset)) {
            $this->lines[] = $value;
        } else {
            $this->lines[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->lines[$offset]);
    }
}