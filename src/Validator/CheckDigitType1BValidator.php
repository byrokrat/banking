<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for type 1B accounts
 *
 * Type1B checksum calculation is made on the entire clearing number, and
 * seven digits of the actual account number.
 */
class CheckDigitType1BValidator extends CheckDigitType1AValidator
{
    protected function processNumber(AccountNumber $number)
    {
        return $number->getClearingNumber() . $number->getSerialNumber() . $number->getCheckDigit();
    }
}
