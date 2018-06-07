<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\Exception\LogicException;

/**
 * Modulo10 calculator
 */
class Modulo10
{
    /**
     * Calculate the modulo 10 check digit for number
     *
     * @throws LogicException If $number is not numerical
     */
    public static function calculateCheckDigit(string $number): string
    {
        if (!ctype_digit($number)) {
            throw new LogicException(
                "Number can only contain numerical characters, found '$number'"
            );
        }

        $weight = 2;
        $sum = 0;

        for ($pos=strlen($number)-1; $pos>=0; $pos--) {
            $tmp = $number[$pos] * $weight;
            $sum += ($tmp > 9) ? (1 + ($tmp % 10)) : $tmp;
            $weight = ($weight == 2) ? 1 : 2;
        }

        $ceil = $sum;

        while ($ceil % 10 != 0) {
            $ceil++;
        }

        return (string)($ceil-$sum);
    }
}
