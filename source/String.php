<?php

class String implements Countable {

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

    public function count() {
        return $this->length();
    }

    public function toLowerCase() {
        $this->string = strtolower($this->string);
        return $this;
    }

    public function toUpperCase() {
        $this->string = strtoupper($this->string);
        return $this;
    }

}
