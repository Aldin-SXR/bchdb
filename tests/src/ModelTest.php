<?php

use PHPUnit\Framework\TestCase;
use BCHDB\Models\Transaction;
use BCHDB\Models\TxInput;
use BCHDB\Models\TxOutput;
use BCHDB\Models\Block;
use BCHDB\Util\Util;

/**
 * System model tests.
 */

class ModelTest extends TestCase {
    
    public function testCorrectlyBuildsATransactionObject() {
        $transaction = (new Transaction())->hash('ec4d31538d0314ac3f298d16b19a7d5bd22b94909baf55e6ce3fe5935bf645ed')
            ->input([
                (new TxInput())->value(0.00005)
                                            ->input(0)
                                            ->address('pz3l9lv9s3k2x6p5zernngvar523dxzexsgpw2wsqe')
                                            ->hash('5929c98273f0265faecf113e56a039541bbd89b06d8f098fbbb9cd298f011c40')
                                            ->scriptSig('3044022021bb81b6cf08c62c7efce3fe6c76315596bb503faf9363ea3cf5394700cc9a120220337e5c1f79b156d6a611dbf89d2f36cf3f720d02e9155e6e8ad9e71954c6ce43[ALL|FORKID] 3044022021bb81b6cf08c62c7efce3fe6c76315596bb503faf9363ea3cf5394700cc9a120220337e5c1f79b156d6a611dbf89d2f36cf3f720d02e9155e6e8ad9e71954c6ce43[ALL|FORKID] 1 635221029800ef84f6cd87d5c9b79e80cf20e05c8e0abe192147cb1427bec0ac59672d3121029800ef84f6cd87d5c9b79e80cf20e05c8e0abe192147cb1427bec0ac59672d3152ae67030')
            ])->output([
                (new TxOutput())->value(0.0000386)
                                              ->output(0)
                                              ->address('qzzlv4k9umddrzes8n65kgd04l67undf8c3fyk6apm')
                                              ->scriptPubKey('OP_DUP OP_HASH160 85f656c5e6dad18b303cf54b21afaff5ee4da93e OP_EQUALVERIFY OP_CHECKSIG'),
                (new TxOutput())->value(0.0000075)
                                              ->output(1)
                                              ->address('qpnssdkyjkh6ew2gp9qalzqex2yspup3tueyw7n3lc')
                                              ->scriptPubKey('OP_DUP OP_HASH160 670836c495afacb9480941df8819328900f0315f OP_EQUALVERIFY OP_CHECKSIG')
            ])->block((new Block())->height(591718)
                                                   ->hash('00000000000000000324ca7be2bbe255bc1ca90cdfc3a5b2598119f8436eecd3')
                                                   ->timestamp(1563369191));
            
        $tx_array = Util::to_array($transaction);
        $this->assertEquals([
            '_id' => 'ec4d31538d0314ac3f298d16b19a7d5bd22b94909baf55e6ce3fe5935bf645ed',
            'in' => [
                [  
                    'v' => 0.00005,
                    'i' => 0,
                    'a' => 'pz3l9lv9s3k2x6p5zernngvar523dxzexsgpw2wsqe',
                    'h' => '5929c98273f0265faecf113e56a039541bbd89b06d8f098fbbb9cd298f011c40',
                    'str' => '3044022021bb81b6cf08c62c7efce3fe6c76315596bb503faf9363ea3cf5394700cc9a120220337e5c1f79b156d6a611dbf89d2f36cf3f720d02e9155e6e8ad9e71954c6ce43[ALL|FORKID] 3044022021bb81b6cf08c62c7efce3fe6c76315596bb503faf9363ea3cf5394700cc9a120220337e5c1f79b156d6a611dbf89d2f36cf3f720d02e9155e6e8ad9e71954c6ce43[ALL|FORKID] 1 635221029800ef84f6cd87d5c9b79e80cf20e05c8e0abe192147cb1427bec0ac59672d3121029800ef84f6cd87d5c9b79e80cf20e05c8e0abe192147cb1427bec0ac59672d3152ae67030'
                ]
            ],
            'out' => [
                [
                    'v' => 0.0000386,
                    'o' =>0,
                    'a' => 'qzzlv4k9umddrzes8n65kgd04l67undf8c3fyk6apm',
                    'str' => 'OP_DUP OP_HASH160 85f656c5e6dad18b303cf54b21afaff5ee4da93e OP_EQUALVERIFY OP_CHECKSIG'
                ],
                [
                    'v' => 0.0000075,
                    'o' =>1,
                    'a' => 'qpnssdkyjkh6ew2gp9qalzqex2yspup3tueyw7n3lc',
                    'str' => 'OP_DUP OP_HASH160 670836c495afacb9480941df8819328900f0315f OP_EQUALVERIFY OP_CHECKSIG'
                ]
                ],
                'blk' => [
                    'i' => 591718,
                    'h' => '00000000000000000324ca7be2bbe255bc1ca90cdfc3a5b2598119f8436eecd3',
                    'ts' => 1563369191
                ]
        ], $tx_array);
    }
}