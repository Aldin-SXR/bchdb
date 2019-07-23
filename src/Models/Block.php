<?php

namespace BCHDB\Models;

class Block {
    public $i;
    public $h;
    public $ts;

    public function height($i) {
        $this->i = $i;
        return $this;
    }

    public function hash($h) {
        $this->h = $h;
        return $this;
    }

    public function timestamp($ts) {
        $this->ts = $ts;
        return $this;
    }
}