<?php
use PHPUnit\Framework\TestCase;
use BCHDB\Client\RpcClient;

require_once __DIR__.'/../../autoload.php';

/**
 * RpcClient tests.
 */

class RpcClientTest extends TestCase {
    /** @var RpcClient $rpc_client RPC client. */
    private static $rpc_client;

    public function testSuccessfullyCreatesAClient() {
        self::$rpc_client = new RpcClient();
        $this->assertInstanceOf(RpcClient::class, self::$rpc_client);
    }

    public function testExecutesARequestWithoutArguments() {
        $response = self::$rpc_client->get_info();
        $this->assertArrayHasKey('version', $response);
        $this->assertArrayHasKey('blocks', $response);
        $this->assertEquals(190200, $response['version']);
    }

    public function testExecutesARequestWithArguments() {
        $response = self::$rpc_client->get_raw_transaction('9fb87a0f3cb840797dae1c3fe597e87fd6934913ba9ddeed55cbf5c8ae395a48', true);
        $this->assertArrayHasKey('txid', $response);
        $this->assertArrayHasKey('vin', $response);
        $this->assertArrayHasKey('vout', $response);
        $this->assertEquals('bitcoincash:qzzlv4k9umddrzes8n65kgd04l67undf8c3fyk6apm', $response['vout'][0]['scriptPubKey']['addresses'][0]);
        $this->assertEquals('bitcoincash:qpnssdkyjkh6ew2gp9qalzqex2yspup3tueyw7n3lc', $response['vout'][1]['scriptPubKey']['addresses'][0]);
    }
}