<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for type 1A accounts
 *
 * Checksum calculation is made on the clearing number with the exception of
 * the first digit, and seven digits of the actual account number.
 */
class CheckDigitType1AValidator extends CheckDigitValidator
{
    protected function calculateCheckDigit(AccountNumber $number): string
    {
        return Modulo11::calculateCheckDigit(
            substr($number->getClearingNumber(), 1) . $number->getSerialNumber()
        );
    }
}
