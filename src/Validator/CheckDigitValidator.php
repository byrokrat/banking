<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidCheckDigitException;
use byrokrat\checkdigit\Calculator;

/**
 * Validate check digits
 */
abstract class CheckDigitValidator implements Validator
{
    /**
     * @var Calculator Checksum calculator
     */
    private $checksum;

    /**
     * Load checksum calculator
     *
     * @param Calculator $checksum
     */
    public function __construct(Calculator $checksum)
    {
        $this->checksum = $checksum;
    }

    /**
     * Validate check digit
     *
     * @param  AccountNumber $number
     * @return null
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    public function validate(AccountNumber $number)
    {
        if (!$this->checksum->isValid($this->processNumber($number))) {
            throw new InvalidCheckDigitException("Invalid check digit in $number");
        }
    }

    /**
     * Get number to validate
     *
     * @param  AccountNumber $number
     * @return string
     */
    abstract protected function processNumber(AccountNumber $number);
}
