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
        return new static(strtolower($this->string));
    }

    public function toUpperCase() {
        return new static(strtoupper($this->string));
    }

    public function contains($string) {
        return strpos($this->string, $string) !== false;
    }

    public function startsWith($string) {
        return !strncmp($this->string, $string, strlen($string));
    }

    public function endsWith($string) {
        return $string == $this->substring(count($this) - strlen($string));
    }

    public function equals($string) {
        return $this->string == $string;
    }

    public function matches($regularExpression) {
        $result = preg_match($regularExpression, $this->string);
        if($result === false) {
            throw new InvalidArgumentException("Possibly malformed regular expression");
        }
        return (bool)$result;
    }

    // equalsIngoringCase?

    public function compareTo($string) {
        return strcmp($string, $this->string);
    }

    // compareToIgnoringCase?

    public function substring($from, $length=null) {
        if($length === null) {
            return new static(substr($this->string, $from));
        }
        return new static(substr($this->string, $from, $length));
    }

    public function trim() {
        return new static(trim($this->string));   
    }

    // replace, replaceRegex?

    // split

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
        throw new BadFunctionCallException("Cannot unset string offsets. Unset was called for position $offset");
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

