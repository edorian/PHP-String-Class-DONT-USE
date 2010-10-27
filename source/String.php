<?php

class String {

    protected $string;

    public function __construct($string) {
        $this->string = (string)$string;
    }

    public function __toString() {
        return $this->string;
    }

    public function length() {
        return strlen($this->string);
    }
}
