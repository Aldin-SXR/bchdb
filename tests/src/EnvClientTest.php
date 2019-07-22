<?php
use PHPUnit\Framework\TestCase;
use BCHDB\EnvClient;

require_once __DIR__.'/../../autoload.php';

/**
 * EnvClient tests.
 */

class EnvClientTest extends TestCase {
    /** @var EnvClient $env RPC client. */
    private static $env;

    public function testSuccessfullyCreatesAClient() {
        self::$env = new EnvClient();
        $this->assertInstanceOf(EnvClient::class, self::$env);
    }

    public function testCorrectlyFetchesEnvironmentVariables() {
        $this->assertNotNull(self::$env->get('RPC_USER'));
        $this->assertNotNull(self::$env->get('RPC_PASSWORD'));
        $this->assertNotNull(self::$env->get('RPC_HOST'));
        $this->assertNotNull(self::$env->get('RPC_PORT'));
        $this->assertEquals(8332, self::$env->get('RPC_PORT'));
    }

    public function testCorrectlyHandlesNonExistingVariables() {
        $this->assertNull(self::$env->get('RPC_NONEXISTING'));
    }
}