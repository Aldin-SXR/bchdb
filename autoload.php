<?php

/**
 * Custom autoload file.
 * Allows for the project environment to be loaded via a single file.
 */

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

/* Load environment variables */
try {
    $dotenv = Dotenv::create(__DIR__);
    $dotenv->load();
} catch (\Throwable $e) {
    print_r("No environment files (.env) found.");
}

