<?php

declare(strict_types=1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Internal factory creating undefined account numbers (not belongning to a bank)
 *
 * It is strict in the sense that if fails on any unexpected characters.
 *
 * For an alternative {@see PermissiveFactory}.
 * For a factory that validates account numbers {@see AccountFactory}.
 */
class StrictFactory implements AccountFactoryInterface
{
    private const CLEARING_SERIAL_DELIMITER = ',';
    private const CLEARING = 'CLEARING';
    private const CLEARING_CHECK = 'CLEARING_CHECK';
    private const SERIAL = 'SERIAL';
    private const CHECK = 'CHECK';

    public function createAccount(string $number): AccountNumber
    {
        $parts = [
            self::CLEARING => '',
            self::CLEARING_CHECK => '',
            self::SERIAL => '',
            self::CHECK => '',
        ];

        foreach (str_split($number) as $pos => $char) {
            if ($char == self::CLEARING_SERIAL_DELIMITER) {
                if (self::terminateClearing($parts)) {
                    continue;
                }
            }

            if (!ctype_digit($char)) {
                throw new InvalidAccountNumberException(
                    "Invalid char ($char) at position $pos, expecting a digit"
                );
            }

            self::pushDigit($char, $parts);
        }

        return new UndefinedAccount(
            $number,
            $parts[self::CLEARING],
            $parts[self::CLEARING_CHECK],
            $parts[self::SERIAL],
            $parts[self::CHECK]
        );
    }

    /**
     * @param array<string, string> $parts
     */
    private static function pushDigit(string $digit, array &$parts): void
    {
        $pending = $parts[self::CHECK];
        $parts[self::CHECK] = $digit;

        if (strlen($parts[self::CLEARING]) < 4) {
            $parts[self::CLEARING] .= $pending;
        } else {
            $parts[self::SERIAL] .= $pending;
        }
    }

    /**
     * @param array<string, string> $parts
     */
    private static function terminateClearing(array &$parts): bool
    {
        $pending = $parts[self::CHECK];
        $parts[self::CHECK] = '';

        if (strlen($parts[self::CLEARING]) == 3) {
            $parts[self::CLEARING] .= $pending;
            return true;
        }

        if (strlen($parts[self::CLEARING]) == 4 && !$parts[self::SERIAL]) {
            $parts[self::CLEARING_CHECK] = $pending;
            return true;
        }

        return false;
    }
}
