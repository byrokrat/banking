<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

/**
 * Formatter for the BGC 16 digit format
 */
class Generic16Formatter implements FormatterInterface
{
    public function format(AccountNumber $number): string
    {
        return $number->getClearingNumber()
            . str_pad($number->getSerialNumber(), 11, '0', STR_PAD_LEFT)
            . $number->getCheckDigit();
    }
}
