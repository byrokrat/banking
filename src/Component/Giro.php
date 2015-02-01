<?php

namespace byrokrat\banking\Component;

use byrokrat\checkdigit\Modulo10;

/**
 * @todo Kan raderas när inga referenser finns längre
 */
trait Giro
{
    use Constructor;

    /**
     * Validate check digit (from Component\Constructor)
     *
     * @return boolean
     */
    protected function isValidCheckDigit()
    {
        return (new Modulo10)->isValid(
            $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
