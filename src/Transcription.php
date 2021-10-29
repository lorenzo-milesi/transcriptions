<?php

namespace LorenzoMilesi\Transcript;

use function array_chunk;
use function array_filter;
use function array_map;
use function file;
use function implode;
use function var_dump;

use const PHP_EOL;

class Transcription
{
    public function __construct(protected array $lines)
    {
        $this->lines = $this->trim($lines);
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): Lines
    {
        return new Lines(array_map(
            fn($line) => new Line(...$line),
            array_chunk($this->lines, 3)
        ));
    }

    protected function trim(array $lines): array
    {
        return array_slice(array_filter(array_map('trim', $lines)), 1);
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->lines);
    }
}