<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class StandardFormatter implements FormatterInterface
{
    public function format(AccountNumber $number): string
    {
        return sprintf(
            '%s%s,%s-%s',
            $number->getClearingNumber(),
            $number->getClearingCheckDigit() !== '' ? '-' . $number->getClearingCheckDigit() : '',
            $number->getSerialNumber(),
            $number->getCheckDigit()
        );
    }
}
