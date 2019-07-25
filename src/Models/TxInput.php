<?php

namespace BCHDB\Models;

class TxInput {
    public $v;
    public $i;
    public $a;
    public $h;
    public $str;

    public function value($value) {
        $this->v = $value;
        return $this;
    }

    public function input($vin) {
        $this->i = $vin;
        return $this;
    }

    public function address($address) {
        $this->a = $address;
        return $this;
    }

    public function hash($hash) {
        $this->h = $hash;
        return $this;
    }

    public function scriptSig($scriptSig) {
        $this->str = $scriptSig;
        return $this;
    }
}