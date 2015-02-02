<?php

namespace byrokrat\banking;

/**
 * Account number interface
 */
interface AccountNumber
{
    /**
     * Get the raw number
     *
     * @return string
     */
    public function getRawNumber();

    /**
     * Get account as string
     *
     * @return string
     */
    public function getNumber();

    /**
     * Get account as string
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
     * Get name of Bank this number belongs to
     *
     * @return string
     */
    public function getBankName();
}
