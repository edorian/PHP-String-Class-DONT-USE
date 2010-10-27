<?php

require_once("source/String.php");

class StringTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->simpleString = "Foo Bar";
        $this->simpleStringObject = new String($this->simpleString);
    }

    public function testToString() {
        $this->assertSame($this->simpleString, (string)$this->simpleStringObject);
    }

    public function testClone() {
        $newString = clone $this->simpleStringObject;
        $this->assertNotSame($newString, $this->simpleStringObject);
    }

    public function testCopy() {
        $newString = $this->simpleStringObject->copy();
        $this->assertNotSame($newString, $this->simpleStringObject);
    }

    public function testLength() {
        $this->assertSame(strlen($this->simpleString), $this->simpleStringObject->length());
    }

    public function testToLowerCase() {
        $this->simpleStringObject->toLowerCase();
        $this->assertSame(strtolower($this->simpleString), (string)$this->simpleStringObject);
    }

    public function testToLowerCaseFluent() {
        $this->assertSame($this->simpleStringObject, $this->simpleStringObject->toLowerCase());
        $this->assertSame(strtolower($this->simpleString), (string)$this->simpleStringObject->toLowerCase());
    }

    public function testToUpperCase() {
        $this->simpleStringObject->toUpperCase();
        $this->assertSame(strtoupper($this->simpleString), (string)$this->simpleStringObject);
    }

    public function testToUpperCaseFluent() {
        $this->assertSame($this->simpleStringObject, $this->simpleStringObject->toUpperCase());
        $this->assertSame(strtoupper($this->simpleString), (string)$this->simpleStringObject->toUpperCase());
    }

}
