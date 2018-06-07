<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\Exception\LogicException;

/**
 * Modulo11 calculator
 */
class Modulo11
{
    /**
     * Map modulo 11 remainder to check digit map
     */
    private const REMAINDER_TO_CHECK_DIGIT_MAP = [
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => 'X',
        11 => '0',
    ];

    /**
     * Calculate the modulo 11 check digit for number
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

        $sum = 0;

        foreach (array_reverse(str_split($number)) as $pos => $digit) {
            $sum += $digit * self::getWeight($pos, 2);
        }

        // Calculate check digit from remainder
        return self::REMAINDER_TO_CHECK_DIGIT_MAP[11 - $sum % 11];
    }

    /**
     * Calculate weight based on position in number
     *
     * @param  int $pos   Position in number (starts from 0)
     * @param  int $start Start value for weight calculation (value of position 0)
     */
    protected static function getWeight(int $pos, int $start = 1): int
    {
        $pos += $start;

        while ($pos > 10) {
            $pos -= 10;
        }

        return $pos;
    }
}
