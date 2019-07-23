<?php

namespace BCHDB\Models;

class Transaction {
    public $_id;
    public $input;
    public $output;
    public $block;

    public function hash($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function input($input) {
        $this->input = $input;
        return $this;
    }

    public function output($output) {
        $this->output = $output;
        return $this;
    }

    public function block($block) {
        $this->block = $block;
        return $this;
    }
}