<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for Handelsbanken accounts
 *
 * Checksum calculation is made on the serial number.
 */
class CheckDigitHandelsbankenValidator extends CheckDigitType1AValidator
{
    protected function processNumber(AccountNumber $number)
    {
        return $number->getSerialNumber() . $number->getCheckDigit();
    }
}
