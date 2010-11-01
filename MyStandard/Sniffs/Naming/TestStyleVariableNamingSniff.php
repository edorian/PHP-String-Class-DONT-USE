<?php

class MyStandard_Sniffs_Naming_TestStyleVariableNamingSniff implements PHP_CodeSniffer_Sniff {

    public function register() {
        return array(T_VARIABLE);
    }

    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
        var_dump($stackPtr);
    }
}
