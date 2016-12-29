<?php

namespace byrokrat\banking;

/**
 * Account number interface
 */
interface AccountNumber
{
    /**
     * Get name of the Bank this number belongs to
     *
     * @return string
     */
    public function getBankName();

    /**
     * Get the raw number
     *
     * @return string
     */
    public function getRawNumber();

    /**
     * Get account number as a formatted string
     *
     * @return string
     */
    public function getNumber();

    /**
     * Get account number as a formatted string
     *
     * Internally calls getNumber()
     *
     * @return string
     */
    public function __toString();

    /**
     * Get clearing number
     *
     * @return string 4 digits
     */
    public function getClearingNumber();

    /**
     * Get the check digit of the clearing number
     *
     * @return string 1 or 0 digits
     */
    public function getClearingCheckDigit();

    /**
     * Get account serial number
     *
     * @return string 1 to 11 digits
     */
    public function getSerialNumber();

    /**
     * Get account check digit
     *
     * @return string 1 digit
     */
    public function getCheckDigit();

    /**
     * Get account as a 16 digit number
     *
     * Clearing number (4 digits) + x number of ceros + serial number
     *
     * @return string 16 digits
     */
    public function get16();

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
     *
     * @param  AccountNumber $account
     * @param  bool          $strict
     * @return bool
     */
    public function equals(AccountNumber $account, $strict = false);
}
