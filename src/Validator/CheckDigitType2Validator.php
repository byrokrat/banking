<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for type 2 accounts
 *
 * Checksum calculation is made on the last ten digits of the serial number.
 */
class CheckDigitType2Validator extends CheckDigitValidator
{
    protected function calculateCheckDigit(AccountNumber $number): string
    {
        return Modulo10::calculateCheckDigit($number->getSerialNumber());
    }
}
