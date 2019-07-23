<?php

namespace BCHDB\Models;

class Block {
    public $height;
    public $hash;
    public $timestamp;

    public function height($height) {
        $this->height = $height;
        return $this;
    }

    public function hash($hash) {
        $this->hash = $hash;
        return $this;
    }

    public function timestamp($timestamp) {
        $this->timestamp = $timestamp;
        return $this;
    }
}