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

}
