<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;
use byrokrat\checkdigit\Modulo11;

/**
 * Validate check digits for type 1A accounts
 *
 * Checksum calculation is made on the clearing number with the exception of
 * the first digit, and seven digits of the actual account number.
 */
class CheckDigitType1AValidator extends CheckDigitValidator
{
    public function __construct(Modulo11 $checksum = null)
    {
        parent::__construct($checksum ?: new Modulo11);
    }

    protected function processNumber(AccountNumber $number)
    {
        return substr($number->getClearingNumber(), 1) . $number->getSerialNumber() . $number->getCheckDigit();
    }
}
