<?php

namespace byrokrat\banking\Validator;

use byrokrat\checkdigit\Modulo11;
use byrokrat\banking\AccountNumberInterface;
use byrokrat\banking\Exception\InvalidCheckDigitException;

/**
 * Validate check digits for type 1B accounts
 */
class Checkdigit1B implements Validator
{
    /**
     * @var Modulo11 Checksum calculator
     */
    private $checksum;

    /**
     * Inject checksum calculator
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
     * Type1B checksum calculation is made on the entire clearing number, and
     * seven digits of the actual account number.
     *
     * @param  AccountNumberInterface $number
     * @return null
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    public function validate(AccountNumberInterface $number)
    {
        $toValidate = $number->getClearingNumber() . $number->getSerialNumber() . $number->getCheckDigit();
        if (!$this->checksum->isValid($toValidate)) {
            throw new InvalidCheckDigitException("Invalid check digit {$number->getCheckDigit()} in $number");
        }
    }
}
