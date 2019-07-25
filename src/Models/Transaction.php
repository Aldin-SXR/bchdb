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

    public function input($input) {
        $this->in = $input;
        return $this;
    }

    public function output($output) {
        $this->out = $output;
        return $this;
    }

    public function block($block) {
        $this->blk = $block;
        return $this;
    }
}