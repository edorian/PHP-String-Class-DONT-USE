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
        $this->string[$offset] = $value;
    }

    public function offsetUnset($offset) {
        throw new Exception("Cannot unset string offsets. Unset was called for position $offset");
    }

    /* /Implement ArrayAccess */

}

/*
            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
                    Version 2, December 2004

 Copyright (C) 2010 Volker Dusch 

 Everyone is permitted to copy and distribute verbatim or modified
 copies of this license document, and changing it is allowed as long
 as the name is changed.

            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

  0. You just DO WHAT THE FUCK YOU WANT TO.
  1. This program is free software. It comes without any warranty, to
     the extent permitted by applicable law. You can redistribute it
     and/or modify it under the terms of the Do What The Fuck You Want
     To Public License, Version 2, as published by Sam Hocevar. See
     http://sam.zoy.org/wtfpl/COPYING for more details.
*/

