<?php

namespace byrokrat\banking\Validator;

use byrokrat\checkdigit\Modulo11;
use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidCheckDigitException;

/**
 * Validate check digit for type 1A accounts.
 */
class Type1AValidator implements Validator
{
    /**
     * @var Modulo11 Checksum calculator
     */
    private $checksum;

    /**
     * Optional injection of checksum calculator
     *
     * @param Modulo11 $checksum
     */
    public function __construct(Modulo11 $checksum = null)
    {
        $this->checksum = $checksum ?: new Modulo11;
    }

    /**
     * Validate check digit
     *
     * Checksum calculation is made on the clearing number with the exception of
     * the first digit, and seven digits of the actual account number.
     *
     * @param  AccountNumber $number
     * @return boolean
     */
    public function isValidCheckDigit(AccountNumber $number)
    {
        return $this->checksum->isValid(
            substr($number->getClearingNumber(), 1) . $number->getSerialNumber() . $number->getCheckDigit()
        );
    }

    /**
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    public function validate(AccountNumber $number)
    {
        if (!$this->isValidCheckDigit($number)) {
            throw new InvalidCheckDigitException(
                "Invalid check digit <{$number->getCheckDigit()}> in <$number>"
            );
        }
    }
}
