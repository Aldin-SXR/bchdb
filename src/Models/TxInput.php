<?php

namespace BCHDB\Models;

class TxInput {
    public $value;
    public $vin;
    public $address;
    public $hash;
    public $scriptSig;

    public function value($value) {
        $this->value = $value;
        return $this;
    }

    public function input($vin) {
        $this->vin = $vin;
        return $this;
    }

    public function address($address) {
        $this->address = $address;
        return $this;
    }

    public function hash($hash) {
        $this->hash = $hash;
        return $this;
    }

    public function string($scriptSig) {
        $this->scriptSig = $scriptSig;
        return $this;
    }
}