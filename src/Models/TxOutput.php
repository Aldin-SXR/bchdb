<?php

namespace BCHDB\Models;

class TxOutput {
    public $value;
    public $vout;
    public $address;
    public $scriptPubKey;

    public function value($value) {
        $this->value = $value;
        return $this;
    }

    public function output($vout) {
        $this->vout = $vout;
        return $this;
    }

    public function address($address) {
        $this->address = $address;
        return $this;
    }

    public function string($scriptPubKey) {
        $this->scriptPubKey = $scriptPubKey;
        return $this;
    }
}