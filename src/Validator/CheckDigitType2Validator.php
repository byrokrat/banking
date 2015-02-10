<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;
use byrokrat\checkdigit\Modulo10;

/**
 * Validate check digits for type 2 accounts
 *
 * Checksum calculation is made on the last ten digits of the serial number.
 */
class CheckDigitType2Validator extends CheckDigitValidator
{
    public function __construct(Modulo10 $checksum = null)
    {
        parent::__construct($checksum ?: new Modulo10);
    }

    protected function processNumber(AccountNumber $number)
    {
        return $number->getSerialNumber() . $number->getCheckDigit();
    }
}
