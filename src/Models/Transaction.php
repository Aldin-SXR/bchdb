<?php

namespace BCHDB\Models;

class Transaction {
    public $_id;
    public $in;
    public $out;
    public $blk;

    public function hash($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function input($in) {
        $this->in = $in;
        return $this;
    }

    public function output($out) {
        $this->out = $out;
        return $this;
    }

    public function block($blk) {
        $this->blk = $blk;
        return $this;
    }
}