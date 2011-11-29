<?php

require_once("source/String.php");

class StringTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->fooBarString = "Foo Bar";
        $this->fooBarStringObject = new String($this->fooBarString);
    }

    public function testSkipped() {
        $this->markTestSkipped();
    }

    public function testIncomplete() {
        $this->markTestIncomplete();
    }
    
    /**
     * @covers String::__toString
     */
    public function testToString() {
        $this->assertSame($this->fooBarString, (string)$this->fooBarStringObject);
    }

    public function testStringIsClonable() {
        $newString = clone $this->fooBarStringObject;
        $this->assertNotSame($newString, $this->fooBarStringObject);
    }

    /**
     * @covers String::copy
     */
    public function testCopyCreatesANewStringInstance() {
        $newString = $this->fooBarStringObject->copy();
        $this->assertInstanceOf("String", $newString);
        $this->assertNotSame($newString, $this->fooBarStringObject);
    }

    /**
     * @covers String::length
     */
    public function testLength() {
        $this->assertSame(strlen($this->fooBarString), $this->fooBarStringObject->length());
    }

    /**
     * @covers String::count
     */
    public function testCountReturnTheStringsLength() {
        $this->assertSame(strlen($this->fooBarString), $this->fooBarStringObject->count());
    }

    /**
     * @covers String::count
     */
    public function testCountableInterfaceReturnsTheStringsLength() {
        $this->assertSame(strlen($this->fooBarString), count($this->fooBarStringObject));
    }

    /**
     * @covers String::toLowerCase
     */
    public function testToLowerCase() {
        $this->assertSame(strtolower($this->fooBarString), (string)$this->fooBarStringObject->toLowerCase());
    }

    /**
     * @covers String::toUpperCase
     */
    public function testToUpperCase() {
        $this->fooBarStringObject->toUpperCase();
        $this->assertSame(strtoupper($this->fooBarString), (string)$this->fooBarStringObject->toUpperCase());
    }

    /**
     * @covers String::contains
     */
    public function testContainsReturnsTrueForAMatchingString() {
        $this->assertTrue($this->fooBarStringObject->contains("Foo"));
        $this->assertTrue($this->fooBarStringObject->contains("Bar"));
    }

    /**
     * @covers String::contains
     */
    public function testContainsReturnsFalseForANonMatchingString() {
        $this->assertFalse($this->fooBarStringObject->contains("Not"));
    }

    /**
     * @covers String::startsWith
     */
    public function testStartsWithWorksForAMachtingString() {
        $this->assertTrue($this->fooBarStringObject->startsWith("Foo"));
    }

    /**
     * @covers String::startsWith
     */
    public function testStartsWithFailsForANonMatchingString() {
        $this->assertFalse($this->fooBarStringObject->startsWith("Bar"));
    }

    /**
     * @covers String::endsWith
     */
    public function testEndsWithWorksForAMatchingString() {
        $this->assertTrue($this->fooBarStringObject->endsWith("Bar"));
    }

    /**
     * @covers String::endsWith
     */
    public function testEndsWithFailsForANonMatchingString() {
        $this->assertFalse($this->fooBarStringObject->endsWith("Foo"));
    }

    /**
     * @covers String::equals
     */
    public function testEqualsDetectsAMatchingString() {
        $string = new String("Foo");
        $this->assertTrue($string->equals("Foo"));
    }

    /**
     * @covers String::equals
     */
    public function testEqualsDetectsANonMatchingString() {
        $string = new String("Bar");
        $this->assertFalse($string->equals("Foo"));
    }

    /**
     * @covers String::compareTo
     */
    public function testCompareToReturnsZeroForMatchingStrings() {
        $this->assertEquals(0, $this->fooBarStringObject->compareTo($this->fooBarString));
    }

    /**
     * @covers String::compareTo
     */
    public function testCompareToReturnsNegativeValueIfPassedInStringIsSmaller() {
        $string = new String("5");
        $result = $string->compareTo("3");
        $this->assertTrue($result < 0, "Comparision result is not smaller than 0 but is $result");
    }

    /**
     * @covers String::matches
     */
    public function testMatchesReturnsTrueForAMatchingRegularExpression() {
        $this->assertTrue($this->fooBarStringObject->matches("~^Foo~"));
    }

    /**
     * @covers String::matches
     */
    public function testMatchesReturnsFalseForANonMatchingRegularExpression() {
        $this->assertFalse($this->fooBarStringObject->matches("~^Bar~"));
    }

    /**
     * @covers String::matches
     * @expectedException InvalidArgumentException
     */
    public function testMatchesFailsForAMalformedRegularExpression() {
        $this->assertTrue(@$this->fooBarStringObject->matches("~Foo/"));
    }

    /**
     * @covers String::compareTo
     */
    public function testCompareToReturnsPositiveValueIfPassedInStringIsBigger() {
        $string = new String("5");
        $result = $string->compareTo("7");
        $this->assertTrue($result > 0, "Comparision result is not smaller than 0 but is $result");
    }

    /**
     * @covers String::substring
     */
    public function testSubstringWorksForTheWholeStringWithOneParameter() {
        $this->assertEquals(new String($this->fooBarString), $this->fooBarStringObject->substring(0));
    }

    /**
     * @covers String::substring
     */
    public function testSubstringWorksForTheWholeStringWithTwoParameters() {
        $this->assertEquals(new String($this->fooBarString), $this->fooBarStringObject->substring(0, 10));
    }

    /**
     * @covers String::substring
     */
    public function testSubstringWorksForAMiddlePartOfTheString() {
        $this->assertEquals(new String("o B"), $this->fooBarStringObject->substring("2", "3"));
    }

    /**
     * @covers String::trim
     */
    public function testTrimCutsSpacesInFrontOfAndAfterTheString() {
        $string = new String(" Foo ");
        $this->assertEquals(new String("Foo"), $string->trim());
    }

    /* Testing ArrayAccess */

    /**
     * @covers String::offsetGet
     */
    public function testArrayAccessInterfaceGet() {
        $this->assertSame($this->fooBarString[0], $this->fooBarStringObject[0]);
        $this->assertSame($this->fooBarString[5], $this->fooBarStringObject[5]);
    }

    /**
     * @covers String::offsetGet
     * @expectedException OutOfBoundsException
     */
    public function testArrayAccessInterfaceGetUninitalisedOffset() {
        $this->fooBarStringObject[100];
    }

    /**
     * @covers String::offsetGet
     * @covers String::offsetSet
     * @covers String::length
     */
    public function testArrayAccessInterfaceSetUninitalisedOffset() {
        $this->fooBarStringObject[100] = "a";
        $this->assertSame("a", $this->fooBarStringObject[100]);
        $this->assertSame(101, $this->fooBarStringObject->length());
    }

    /**
     * @covers String::offsetGet
     * @covers String::offsetSet
     */ 
    public function testArrayAccessInterfaceSettingUninitialisedOffsetCreatesWhitespace() {
        $this->fooBarStringObject[100] = "a";
        $this->assertSame(" ", $this->fooBarStringObject[99]);
    }

    /**
     * @covers String::offsetUnset
     * @expectedException BadFunctionCallException
     */
    public function testArrayAccessInterfaceUnset() {
        unset($this->fooBarStringObject[1]);
    }

    /**
     * @covers String::offsetExists
     */
    public function testArrayAccessInterfaceOffsetExists() {
        $this->assertTrue(isset($this->fooBarStringObject[3]));
        $this->assertFalse(isset($this->fooBarStringObject[100]));
    }

    /* /Testing ArrayAccess */

}


