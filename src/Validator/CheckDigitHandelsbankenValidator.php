<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for Handelsbanken accounts
 *
 * Checksum calculation is made on the serial number.
 */
class CheckDigitHandelsbankenValidator extends CheckDigitValidator
{
    protected function calculateCheckDigit(AccountNumber $number): string
    {
        return Modulo11::calculateCheckDigit($number->getSerialNumber());
    }
}
