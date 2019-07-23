<?php

namespace BCHDB\Models;

class TxOutput {
    public $v;
    public $o;
    public $a;
    public $str;

    public function value($v) {
        $this->v = $v;
        return $this;
    }

    public function output($o) {
        $this->o = $o;
        return $this;
    }

    public function address($a) {
        $this->a = $a;
        return $this;
    }

    public function string($str) {
        $this->str = $str;
        return $this;
    }
}