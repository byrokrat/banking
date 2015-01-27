<?php

namespace byrokrat\banking\Component;

use byrokrat\checkdigit\Modulo11;

/**
 * Helper that implements isValidCheckDigit() for Type1A accounts
 */
trait Type1A
{
    use Type1;

    /**
     * Validate check digit (from Component\Constructor)
     *
     * Type1A checksum calculation is made on the clearing number with the exception
     * of the first digit, and seven digits of the actual account number.
     *
     * @return boolean
     * @todo   Should use validator instead
     */
    protected function isValidCheckDigit()
    {
        return (new Modulo11)->isValid(
            substr($this->getClearingNumber(), 1) . $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
