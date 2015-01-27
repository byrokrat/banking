<?php

namespace byrokrat\banking\Component;

use byrokrat\checkdigit\Modulo11;

/**
 * Helper that implements isValidCheckDigit() for Type1B accounts
 */
trait Type1B
{
    use Type1;

    /**
     * Validate check digit (from Component\Constructor)
     *
     * Type1B checksum calculation is made on the entire Ccearing number, and
     * seven digits of the actual account number.
     *
     * @return boolean
     * @todo   Should use validator instead
     */
    protected function isValidCheckDigit()
    {
        return (new Modulo11)->isValid(
            $this->getClearingNumber() . $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
