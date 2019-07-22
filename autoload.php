<?php

/**
 * Custom autoload file.
 * Allows for the project environment to be loaded via a single file.
 */

require_once __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

/* Load environment variables */
$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

