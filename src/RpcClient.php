<?php

namespace BCHDB;
use GuzzleHttp\Client;

/**
 * RpcClient.
 * A class implementing the Guzzle HTTP library to communicate with the blockchain RPC.
 * 
 * @method array get_info get_info() Get information about the current state of the blockchain node.
 * @method array get_raw_transaction(string $tx_hash, boolean $verbose) Get raw transaction details.
 */

class RpcClient {
    /** @var GuzzleHttp\Client $client Guzzle HTTP client. */
    private $client;

    /**
     * Create an RPC client.
     * @return RpcClient
     */
    public function __construct() {
        $this->client = new Client([
            'base_uri' => $_ENV['RPC_HOST'].':'.$_ENV['RPC_PORT']
        ]);
    }

    /**
     * Execute an RPC call.
     * Takes the RPC method and parameters, and returns data from the blockchain node.
     * @param string $method RPC method name.
     * @param string $params RPC parameters given as a string.
     * @return string Server response.
     */
    private function execute_rpc_call($method, $params) {
        $response = $this->client->request('POST', '/', [
            'auth' => [ $_ENV['RPC_USER'], $_ENV['RPC_PASSWORD'] ],
            'body' => '{
                "jsonrpc": "1.0",
                "id": "bchdb-'.Util::random_id().'",
                "method": "'.$method.'",
                "params": '.$params.'
            }'
        ]);
        return (string) $response->getBody(true);
    }

    /**
     * Handle Bitcoin RPC calls (magic method).
     * Takes the name of the RPC method and its arguments, and formats them to shape usable by Bitcoin RPC.
     * @param string $name Method name.
     * @param array $arguments Method arguments.
     * @return array RPC response.
     */
    public function __call($name, $arguments) {
        $name = str_replace('_', '', $name);
        empty($arguments) && $rpc_arguments = '[]';
        !empty($arguments) && $rpc_arguments = json_encode($arguments);
        
        /* Handle and process response */
        try {
            $response = json_decode($this->execute_rpc_call($name, $rpc_arguments), true);
            return $response['result'];
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}