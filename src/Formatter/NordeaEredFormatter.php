<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

/**
 * Format account numbers as done in Nordea eRedovisning
 */
class NordeaEredFormatter implements FormatterInterface
{
    public function format(AccountNumber $number): string
    {
        if ($number->getClearingNumber() == '3300') {
            return $number->getSerialNumber() . $number->getCheckDigit();
        }

        return $number->getClearingNumber()
            . $number->getClearingCheckDigit()
            . $number->getSerialNumber()
            . $number->getCheckDigit();
    }
}
