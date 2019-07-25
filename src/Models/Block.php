<?php

namespace BCHDB\Models;

class Block {
    public $i;
    public $h;
    public $ts;

    public function height($height) {
        $this->i = $height;
        return $this;
    }

    public function hash($hash) {
        $this->h = $hash;
        return $this;
    }

    public function timestamp($timestamp) {
        $this->ts = $timestamp;
        return $this;
    }
}