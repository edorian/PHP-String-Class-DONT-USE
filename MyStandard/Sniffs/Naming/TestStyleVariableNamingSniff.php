<?php

class MyStandard_Sniffs_Naming_TestStyleVariableNamingSniff implements PHP_CodeSniffer_Sniff {

    public function register() {
        return array(T_VARIABLE);
    }

    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
        $tokens = $phpcsFile->getTokens();
        $name = $tokens[$stackPtr]['content'];
        // Cut the $ sign
        $name = substr($name, 1);
        if($name[0] == "_") {
            $name = substr($name, 1);
        }
        if(strlen($name) > 1 && !preg_match("~^[bifas][A-Z]~", $name)) {
            $phpcsFile->addError(
                "Variable Name: '%s' does not match naming conventions",
                $stackPtr,
                '',
                $tokens[$stackPtr]['content']
            );
        }
    }
}
