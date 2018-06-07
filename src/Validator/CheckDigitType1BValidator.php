<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for type 1B accounts
 *
 * Type1B checksum calculation is made on the entire clearing number, and
 * seven digits of the actual account number.
 */
class CheckDigitType1BValidator extends CheckDigitValidator
{
    protected function calculateCheckDigit(AccountNumber $number): string
    {
        return Modulo11::calculateCheckDigit($number->getClearingNumber() . $number->getSerialNumber());
    }
}
