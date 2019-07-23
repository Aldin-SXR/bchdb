<?php

require_once 'autoload.php';

use BCHDB\Client\RpcClient;
use BCHDB\Client\DbClient;
use BCHDB\Client\EnvClient;
use BCHDB\Util\Util;
use BCHDB\Util\Stopwatch;

use BCHDB\Models\Transaction;
use BCHDB\Models\Block;
use BCHDB\Models\TxOutput;
use BCHDB\Models\TxInput;

/* Client initializations */
$rpc = new RpcClient();
$db = new DbClient();
$env = new EnvClient();
$sw = new Stopwatch('[BCHDB]');

/* Create collection indices if they do not exist */
$sw->log('Setting up database indices...');
$db->collection('confirmed')->index([
    [ 'blk.i' => 1 ], [ 'in.a' => 1 ], [ 'out.a' => 1 ]
]);

/* Checkpointing (whether to start from the SYNC_FROM or a saved chackpoint) */
if (file_exists('checkpoint') && $checkpoint = ((int) file_get_contents('checkpoint') + 1)) {
    $sw->log('Starting from checkpoint: '. $checkpoint);
} 

if (!isset($checkpoint)) {
    $checkpoint = (int) $env->get('SYNC_FROM');
    $sw->log('Checkpoint not found, starting with SYNC_FROM: '. $checkpoint);
}

/* Current block height */
$current_height = $rpc->get_block_count();
$sw->log('Latest block: ' . $current_height . "\n");

for ($blk = $checkpoint; $blk <= $current_height; $blk++) {
    $sw->start('Indexing block '.$blk.'...');

    $block_data = $rpc->get_block($rpc->get_block_hash($blk));
    $sw->log('Number of transactions: '. count($block_data['tx']));

    /* Transaction processing */
    foreach ($block_data['tx'] as $tx) {

        $tx_data = $rpc->get_raw_transaction($tx, true);

        /* Process transaction inputs */
        $in_txs = [ ];
        foreach ($tx_data['vin'] as $vin) {
            $is_coinbase = array_key_exists('coinbase', $vin);
            !$is_coinbase && $prev_txo = $rpc->get_raw_transaction($vin['txid'], true)['vout'];
            $in_txs[ ] = (new TxInput())->hash($is_coinbase ? NULL : $vin['txid'])
                                                            ->value($is_coinbase ? 0 : $prev_txo[$vin['vout']]['value'])
                                                            ->input($is_coinbase ? 0 : $vin['vout'])
                                                            ->address($is_coinbase ? 'coinbase' : explode(':', $prev_txo[$vin['vout']]['scriptPubKey']['addresses'][0])[1])
                                                            ->string($is_coinbase ? NULL : $vin['scriptSig']['asm']);
                                                            
        }

        /* Process transaction outputs */
        $out_txs = [ ];
        foreach ($tx_data['vout'] as $vout) {
            $out_txs[ ] = (new TxOutput())->value($vout['value'])
                                                                ->output($vout['n'])
                                                                ->address(array_key_exists('addresses', $vout['scriptPubKey']) ? explode(':', $vout['scriptPubKey']['addresses'][0])[1] : NULL)
                                                                ->string($vout['scriptPubKey']['asm']);
        }

        /* Format and insert */
        $block = (new Block())->height($block_data['height'])
                                                ->hash($block_data['hash'])
                                                ->timestamp($block_data['time']);
        $transaction = (new Transaction())->hash($tx)
                                                        ->input($in_txs)
                                                        ->output($out_txs)
                                                        ->block($block);

        $tx_array = Util::to_array($transaction);
        $processed_tx = Util::array_filter_recursive($tx_array);
        $db->collection('confirmed')->upsert($tx, $processed_tx);
    }

    /* Update tip and finish block */
    file_put_contents('checkpoint', $blk);
    $sw->stop('Block '. $blk .' successfully indexed');
}

// TODO: Unconfirmed transactions.
