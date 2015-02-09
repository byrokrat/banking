<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for type 1A accounts
 */
class CheckdigitType1AValidator implements Validator
{
    use Modulo11Trait;

    /**
     * Validate check digit
     *
     * Checksum calculation is made on the clearing number with the exception of
     * the first digit, and seven digits of the actual account number.
     *
     * @param  AccountNumber $number
     * @return null
     */
    public function validate(AccountNumber $number)
    {
        $this->validateModulo11(
            substr($number->getClearingNumber(), 1) . $number->getSerialNumber() . $number->getCheckDigit()
        );
    }
}
