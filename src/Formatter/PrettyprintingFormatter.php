<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class PrettyprintingFormatter implements FormatterInterface
{
    public function format(AccountNumber $number): string
    {
        if ($number->getClearingNumber() == '3300') {
            return sprintf(
                '%s,%s-%s%s',
                $number->getClearingNumber(),
                substr($number->getSerialNumber(), 0, -3),
                substr($number->getSerialNumber(), -3),
                $number->getCheckDigit()
            );
        }

        return sprintf(
            '%s%s,%s-%s',
            $number->getClearingNumber(),
            $number->getClearingCheckDigit() !== '' ? '-' . $number->getClearingCheckDigit() : '',
            trim(chunk_split($number->getSerialNumber(), 3, ' ')),
            $number->getCheckDigit()
        );
    }
}
