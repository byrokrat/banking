<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Exception\InvalidCheckDigitException;
use byrokrat\checkdigit\Modulo11;

/**
 * Validate modulo 11 check digits
 */
trait Modulo11Trait
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
     * @param  string $number
     * @return null
     * @throws InvalidCheckDigitException If check digit is not valid
     */
    protected function validateModulo11($number)
    {
        if (!$this->checksum->isValid($number)) {
            throw new InvalidCheckDigitException("Invalid check digit in $number");
        }
    }
}
