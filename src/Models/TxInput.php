<?php

namespace BCHDB\Models;

class TxInput {
    public $v;
    public $i;
    public $a;
    public $h;
    public $str;

    public function value($v) {
        $this->v = $v;
        return $this;
    }

    public function input($i) {
        $this->i = $i;
        return $this;
    }

    public function address($a) {
        $this->a = $a;
        return $this;
    }

    public function hash($h) {
        $this->h = $h;
        return $this;
    }

    public function string($str) {
        $this->str = $str;
        return $this;
    }
}