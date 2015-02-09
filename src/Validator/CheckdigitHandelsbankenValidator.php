<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for Handelsbanken accounts
 */
class CheckdigitHandelsbankenValidator implements Validator
{
    use Modulo11Trait;

    /**
     * Validate check digit
     *
     * Checksum calculation is made on the serial number.
     *
     * @param  AccountNumber $number
     * @return null
     */
    public function validate(AccountNumber $number)
    {
        $this->validateModulo11($number->getSerialNumber() . $number->getCheckDigit());
    }
}
