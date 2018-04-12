<?php

namespace byrokrat\banking;

/**
 * Account number interface
 */
interface AccountNumber
{
    /**
     * Get name of the Bank this number belongs to
     */
    public function getBankName(): string;

    /**
     * Get account number as a formatted string
     */
    public function getNumber(): string;

    /**
     * Get account number as a formatted string
     */
    public function __toString(): string;

    /**
     * Get clearing number (4 digits)
     */
    public function getClearingNumber(): string;

    /**
     * Get the check digit of the clearing number (1 or 0 digits)
     */
    public function getClearingCheckDigit(): string;

    /**
     * Get account serial number (1 to 11 digits)
     */
    public function getSerialNumber(): string;

    /**
     * Get account check digit (1 digit)
     */
    public function getCheckDigit(): string;

    /**
     * Get account as a 16 digit number
     *
     * Clearing number (4 digits) + x number of ceros + serial number
     */
    public function get16(): string;

    /**
     * Check if account is considered equal to this account
     *
     * The bank name, clearing, serial and check digits must match for
     * accounts to be considered equal.
     *
     * If a clearing check digits are present in both accounts they must
     * match. If only one account contain a clearing check digit it is
     * ignored, except when strict mode is enforced. In strict mode a
     * missing clearing check digit on one of the accounts is considered
     * a sign of non-equality.
     */
    public function equals(AccountNumber $account, bool $strict = false): bool;
}
