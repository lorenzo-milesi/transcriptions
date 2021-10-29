<?php

namespace LorenzoMilesi\Transcript;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    /**
     * @param  array<Line>  $items
     */
    public function __construct(protected array $items) { }

    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function map(callable $fn): self
    {
        return new static(array_map($fn, $this->items));
    }
}