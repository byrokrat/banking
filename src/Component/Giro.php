<?php

namespace byrokrat\banking\Component;

use byrokrat\checkdigit\Modulo10;

/**
 * Helper that implements isValidCheckDigit() for Bankgiro and PlusGiro
 */
trait Giro
{
    use Constructor;

    /**
     * Validate check digit (from Component\Constructor)
     *
     * @return boolean
     * @todo   Should use validator instead
     */
    protected function isValidCheckDigit()
    {
        return (new Modulo10)->isValid(
            $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
