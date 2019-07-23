<?php

namespace BCHDB\Client;

/**
 * Environment client for encapsulating superglobal variables.
 */

class EnvClient {
    /** @var array $env Array of environment variables. */
    private $env;

    /**
     * Initialize EnvClient.
     * Assign the environment superglobal to the 'env' property.
     * @return EnvClient
     */
    public function __construct() {
        $this->env = &$_ENV;
    }

    /**
     * Get an environment variable.
     * Fetch an environment variable by name.
     * @param string $name Environment variable name.
     * @return string Environment variable value.
     */
    public function get($name) {
        return (isset($this->env[$name]) ? $this->env[$name] : NULL);
    }
}