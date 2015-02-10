<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidCheckDigitException;
use byrokrat\checkdigit\Modulo10;

/**
 * Validate clearing number check digits
 */
class ClearingCheckDigitValidator implements Validator
{
    /**
     * @var Modulo10 Checksum calculator
     */
    private $checksum;

    /**
     * Load checksum calculator
     *
     * @param Modulo10 $checksum
     */
    public function __construct(Modulo10 $checksum = null)
    {
        $this->checksum = $checksum ?: new Modulo10;
    }

    /**
     * Validate clearing number check digit
     *
     * If no clearing check digit exists number is considered valid.
     *
     * @param  AccountNumber $number
     * @return null
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    public function validate(AccountNumber $number)
    {
        if ($checkDigit = $number->getClearingCheckDigit()) {
            if (!$this->checksum->isValid($number->getClearingNumber() . $checkDigit)) {
                throw new InvalidCheckDigitException("Invalid clearing number check digit in $number");
            }
        }
    }
}
