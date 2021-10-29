<?php

namespace Tests;

use LorenzoMilesi\Transcript\Line;
use LorenzoMilesi\Transcript\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{
    protected Transcription $transcription;

    /**
     * @test
     * @covers Transcription::load
     */
    public function it_loads_a_vtt_file_as_a_string(): void
    {
        $this->assertStringContainsString('Here is a', $this->transcription);
    }

    /**
     * @test
     * @covers Transcription::lines()
     */
    public function it_can_convert_to_an_array_of_line_objects(): void
    {
        $this->assertCount(2, $this->transcription->lines());
        $this->assertContainsOnlyInstancesOf(Line::class, $this->transcription->lines());
    }

    /**
     * @test
     * @covers Transcription::lines()
     */
    public function it_discards_irrelevant_lines_from_the_vtt_file(): void
    {
        $this->assertStringNotContainsString('WEBVTT', $this->transcription);
    }

    /**
     * @test
     * @covers Transcription::htmlLines()
     */
    public function it_renders_the_lines_as_html(): void
    {
        $expected = <<<EOT
            <a href="?time=00:03">Here is a</a>
            <a href="?time=00:04">example of a VTT file.</a>
            EOT;

        $this->assertEquals($expected, $this->transcription->lines()->asHtml());
    }

    protected function setUp(): void
    {
        $this->transcription = Transcription::load(__DIR__.'/stubs/basic-example.vtt');
    }
}