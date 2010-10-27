<?php

class String implements Countable, ArrayAccess {

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


    /* Implement ArrayAccess */
    public function offsetExists($offset) {
        if(isset($this->string[$offset])) {
            return true;
        }
        return false;
    }

    public function offsetGet($offset) {
        if(isset($this->string[$offset])) {
            return $this->string[$offset];
        }
        throw new OutOfBoundsException("Uninitialized string offset: $offset");
    }

    public function offsetSet($offset, $value) {

    }

    public function offsetUnset($offset) {

    }


    /* /Implement ArrayAccess */


}
