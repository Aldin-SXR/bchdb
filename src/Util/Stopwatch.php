<?php

namespace BCHDB\Util;

/**
 * A simple stopwatch logger.
 */
class Stopwatch {
    /** @var double $start Starting time of the stopwatch */
    private $start;
    /** @var string $prefix Prefix all outputs with a user-defined string. */
    private $prefix = '';

    /**
     * Create a Stopwatch object.
     * @param string $prefix Prefix to be used with log messages.
     * @return Stopwatch
     */
    public function __construct($prefix = NULL) {
        $prefix && $this->prefix = $prefix.' ';
    }

    /**
     * Start the stopwatch.
     * Start off the time measurement, along with an intro message.
     * @param string $message Introductory message.
     * @return double Time of start. 
     */
    public function start($message = NULL) {
        $this->start = microtime(true);
        $message && print_r($this->prefix . $message."\n");
        return $this->start;
    }

    /**
     * Log a message.
     * Display a message to the output.
     * @param string $message Message to be logged/displayed.
     * @return void
     */
    public function log($message) {
        print_r($this->prefix . $message."\n");
    }

    /**
     * Stop the stopwatch.
     * Stop the time measurement, and log a closing message.
     * @param string $message Closing message.
     * @return double End time.
     */
    public function stop($message = NULL) {
        $message && print_r($this->prefix . $message."\n");
        $end = +round((microtime(true) - $this->start), 4) * 1000;
        print_r($this->prefix . 'Operation completed in: '. $end ." ms\n\n");
        return $end;
    }
}