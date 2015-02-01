<?php

namespace byrokrat\banking\Validator;

use byrokrat\checkdigit\Modulo10;
use byrokrat\banking\AccountNumberInterface;
use byrokrat\banking\Exception\InvalidCheckDigitException;

/**
 * Validate check digits for type 2 accounts
 */
class Checkdigit2 implements Validator
{
    /**
     * @var Modulo10 Checksum calculator
     */
    private $checksum;

    /**
     * Inject checksum calculator
     *
     * @param Modulo10 $checksum
     */
    public function __construct(Modulo10 $checksum = null)
    {
        $this->checksum = $checksum ?: new Modulo10;
    }

    /**
     * Validate check digit
     *
     * Checksum calculation is made on the last ten digits serial number
     * using the modulus 10 check.
     *
     * @param  AccountNumberInterface $number
     * @return null
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    public function validate(AccountNumberInterface $number)
    {
        if (!$this->checksum->isValid($number->getSerialNumber() . $number->getCheckDigit())) {
            throw new InvalidCheckDigitException("Invalid check digit {$number->getCheckDigit()} in $number");
        }
    }
}
