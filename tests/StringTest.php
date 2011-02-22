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

    public function testCount() {
        $this->assertSame(strlen($this->simpleString), $this->simpleStringObject->count());
    }

    public function testCountableInterface() {
        $this->assertSame(strlen($this->simpleString), count($this->simpleStringObject));
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



    /* Testing ArrayAccess */

    public function testArrayAccessInterfaceGet() {
        $this->assertSame($this->simpleString[0], $this->simpleStringObject[0]);
        $this->assertSame($this->simpleString[5], $this->simpleStringObject[5]);
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testArrayAccessInterfaceGetUninitalisedOffset() {
        $this->simpleStringObject[100];
    }

    public function testArrayAccessInterfaceSetUninitalisedOffset() {
        $this->simpleStringObject[100] = "a";
        $this->assertSame("a", $this->simpleStringObject[100]);
        $this->assertSame(101, $this->simpleStringObject->length());
    }

    public function testArrayAccessInterfaceSettingUninitialisedOffsetCreatesWhitespace() {
        $this->simpleStringObject[100] = "a";
        $this->assertSame(" ", $this->simpleStringObject[99]);
    }

    /**
     * @expectedException Exception
     */
    public function testArrayAccessInterfaceUnset() {
        unset($this->simpleStringObject[1]);
    }

    public function testArrayAccessInterfaceOffsetExists() {
        $this->assertTrue(isset($this->simpleStringObject[3]));
        $this->assertFalse(isset($this->simpleStringObject[100]));
    }

    /* /Testing ArrayAccess */

}


