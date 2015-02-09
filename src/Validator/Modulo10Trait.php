<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Exception\InvalidCheckDigitException;
use byrokrat\checkdigit\Modulo10;

/**
 * Validate modulo 10 check digits
 */
trait Modulo10Trait
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
     * @param  string $number
     * @return null
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    protected function validateModulo10($number)
    {
        if (!$this->checksum->isValid($number)) {
            throw new InvalidCheckDigitException("Invalid check digit in $number");
        }
    }
}
