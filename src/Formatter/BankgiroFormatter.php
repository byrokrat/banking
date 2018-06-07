<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class BankgiroFormatter implements FormatterInterface
{
    public function format(AccountNumber $number): string
    {
        return sprintf(
            '%s-%s%s',
            substr($number->getSerialNumber(), 0, -3),
            substr($number->getSerialNumber(), -3),
            $number->getCheckDigit()
        );
    }
}
