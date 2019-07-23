<?php
use PHPUnit\Framework\TestCase;
use BCHDB\Util\Stopwatch;

/**
 * Stopwatch tests.
 */

class StopwatchTest extends TestCase {
    /** @var Stopwatch $sw Stopwatch object. */
    private static $sw;

    public function testSuccessfullyCreatesAStopwatch() {
        self::$sw = new Stopwatch('[TEST]');
        $this->assertInstanceOf(Stopwatch::class, self::$sw);
    }

    public function testStartsTheStopwatchWithAMessage() {
        ob_start();
        $start = self::$sw->start('Starting the stopwatch...');
        $output = ob_get_clean();

        $this->assertTrue(is_float($start));
        $this->assertEquals("[TEST] Starting the stopwatch...\n", $output);
    }

    public function testLogsAMessage() {
        ob_start();
        self::$sw->log('Logging...');
        $output = ob_get_clean();

        $this->assertEquals("[TEST] Logging...\n", $output);
    }

    public function testStopsTheStopwatchWithAMessage() {
        ob_start();
        $stop = self::$sw->stop('Stopping the stopwatch...');
        $output = explode("\n", ob_get_clean());

        $this->assertTrue(is_float($stop));
        $this->assertEquals('[TEST] Stopping the stopwatch...', $output[0]);
        $this->assertStringStartsWith("[TEST] Operation completed in", $output[1]);
    }
}