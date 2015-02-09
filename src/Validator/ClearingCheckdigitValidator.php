<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;

/**
 * Validate clearing number check digits
 */
class ClearingCheckdigitValidator implements Validator
{
    use Modulo10Trait;

    /**
     * Validate clearing number check digit
     *
     * If no clearing check digit exists number is considered valid.
     *
     * @param  AccountNumber $number
     * @return null
     */
    public function validate(AccountNumber $number)
    {
        if ($checkDigit = $number->getClearingCheckDigit()) {
            $this->validateModulo10($number->getClearingNumber() . $checkDigit);
        }
    }
}
