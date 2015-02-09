<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;

/**
 * Validate check digits for type 1B accounts
 */
class CheckdigitType1BValidator implements Validator
{
    use Modulo11Trait;

    /**
     * Validate check digit
     *
     * Type1B checksum calculation is made on the entire clearing number, and
     * seven digits of the actual account number.
     *
     * @param  AccountNumber $number
     * @return null
     */
    public function validate(AccountNumber $number)
    {
        $this->validateModulo11(
            $number->getClearingNumber() . $number->getSerialNumber() . $number->getCheckDigit()
        );
    }
}
