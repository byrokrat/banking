<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class PlusgiroFormatter implements FormatterInterface
{
    public function format(AccountNumber $number): string
    {
        return sprintf(
            '%s-%s',
            $number->getSerialNumber(),
            $number->getCheckDigit()
        );
    }
}
