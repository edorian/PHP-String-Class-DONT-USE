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

}
