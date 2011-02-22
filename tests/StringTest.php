<?php

require_once("source/String.php");

class StringTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->fooBarString = "Foo Bar";
        $this->fooBarStringObject = new String($this->fooBarString);
    }

    public function testToString() {
        $this->assertSame($this->fooBarString, (string)$this->fooBarStringObject);
    }

    public function testClone() {
        $newString = clone $this->fooBarStringObject;
        $this->assertNotSame($newString, $this->fooBarStringObject);
    }

    public function testCopy() {
        $newString = $this->fooBarStringObject->copy();
        $this->assertNotSame($newString, $this->fooBarStringObject);
    }

    public function testLength() {
        $this->assertSame(strlen($this->fooBarString), $this->fooBarStringObject->length());
    }

    public function testCount() {
        $this->assertSame(strlen($this->fooBarString), $this->fooBarStringObject->count());
    }

    public function testCountableInterface() {
        $this->assertSame(strlen($this->fooBarString), count($this->fooBarStringObject));
    }

    public function testToLowerCase() {
        $this->fooBarStringObject->toLowerCase();
        $this->assertSame(strtolower($this->fooBarString), (string)$this->fooBarStringObject);
    }

    public function testToLowerCaseFluent() {
        $this->assertSame($this->fooBarStringObject, $this->fooBarStringObject->toLowerCase());
        $this->assertSame(strtolower($this->fooBarString), (string)$this->fooBarStringObject->toLowerCase());
    }

    public function testToUpperCase() {
        $this->fooBarStringObject->toUpperCase();
        $this->assertSame(strtoupper($this->fooBarString), (string)$this->fooBarStringObject);
    }

    public function testToUpperCaseFluent() {
        $this->assertSame($this->fooBarStringObject, $this->fooBarStringObject->toUpperCase());
        $this->assertSame(strtoupper($this->fooBarString), (string)$this->fooBarStringObject->toUpperCase());
    }

    public function testStartsWithWorksForAMachtingString() {
        $this->assertTrue($this->fooBarStringObject->startsWith("Foo"));
    }

    public function testStartsWithFailsForANonMatchingString() {
        $this->assertFalse($this->fooBarStringObject->startsWith("Bar"));
    }

    public function testEndsWithWorksForAMatchingString() {
        $this->assertTrue($this->fooBarStringObject->endsWith("Bar"));
    }

    public function testEndsWithFailsForANonMatchingString() {
        $this->assertFalse($this->fooBarStringObject->endsWith("Foo"));
    }

    public function testSubstringWorksForTheWholeString() {
        $this->assertEquals(new String($this->fooBarString), $this->fooBarStringObject->substring(0, 10));
    }

    public function testSubstringWorksForAMiddlePartOfTheString() {
        $this->assertEquals(new String("o B"), $this->fooBarStringObject->substring("2", "3"));
    }


    /* Testing ArrayAccess */

    public function testArrayAccessInterfaceGet() {
        $this->assertSame($this->fooBarString[0], $this->fooBarStringObject[0]);
        $this->assertSame($this->fooBarString[5], $this->fooBarStringObject[5]);
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testArrayAccessInterfaceGetUninitalisedOffset() {
        $this->fooBarStringObject[100];
    }

    public function testArrayAccessInterfaceSetUninitalisedOffset() {
        $this->fooBarStringObject[100] = "a";
        $this->assertSame("a", $this->fooBarStringObject[100]);
        $this->assertSame(101, $this->fooBarStringObject->length());
    }

    public function testArrayAccessInterfaceSettingUninitialisedOffsetCreatesWhitespace() {
        $this->fooBarStringObject[100] = "a";
        $this->assertSame(" ", $this->fooBarStringObject[99]);
    }

    /**
     * @expectedException Exception
     */
    public function testArrayAccessInterfaceUnset() {
        unset($this->fooBarStringObject[1]);
    }

    public function testArrayAccessInterfaceOffsetExists() {
        $this->assertTrue(isset($this->fooBarStringObject[3]));
        $this->assertFalse(isset($this->fooBarStringObject[100]));
    }

    /* /Testing ArrayAccess */

}


