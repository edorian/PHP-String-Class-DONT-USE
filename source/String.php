<?php

class String {

    protected $string;

    public function __construct($string) {
        $this->string = (string)$string;
    }

    public function __toString() {
        return $this->string;
    }

    public function copy() {
        return clone $this;
    }

    public function length() {
        return strlen($this->string);
    }

    public function toLowerCase() {
        $this->string = strtolower($this->string);
        return $this;
    }
}
