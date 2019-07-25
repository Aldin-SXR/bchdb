<?php

namespace BCHDB\Models;

class TxOutput {
    public $v;
    public $o;
    public $a;
    public $str;

    public function value($value) {
        $this->v = $value;
        return $this;
    }

    public function output($vout) {
        $this->o = $vout;
        return $this;
    }

    public function address($address) {
        $this->a = $address;
        return $this;
    }

    public function scriptPubKey($scriptPubKey) {
        $this->str = $scriptPubKey;
        return $this;
    }
}