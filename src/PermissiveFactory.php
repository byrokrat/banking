<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Internal factory creating undefined account numbers (not belongning to a bank)
 *
 * It is permissive in the following respects:
 * - spaces ( ), hyphens (-) and dots (.) are ignored
 * - missplaced clearing-serial delimiters (,) are ignored
 *
 * For an alternative {@see StrictFactory}.
 * For a factory that validates account numbers {@see AccountFactory}.
 */
class PermissiveFactory implements AccountFactoryInterface
{
    private const CLEARING_SERIAL_DELIMITER = ',';
    private const IGNORED_CHARS = [' ', '-', '.'];
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
            if (in_array($char, self::IGNORED_CHARS)) {
                continue;
            }

            if ($char == self::CLEARING_SERIAL_DELIMITER) {
                self::terminateClearing($parts);
                continue;
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
    private static function terminateClearing(array &$parts): void
    {
        $pending = $parts[self::CHECK];
        $parts[self::CHECK] = '';

        if (strlen($parts[self::CLEARING]) < 4) {
            $parts[self::CLEARING] .= $pending;
        } elseif (!$parts[self::SERIAL]) {
            $parts[self::CLEARING_CHECK] = $pending;
        } else {
            $parts[self::CHECK] = $pending;
        }
    }
}
