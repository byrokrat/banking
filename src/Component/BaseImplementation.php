<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking\Component;

/**
 * Base implementation of the AccountNumber interface
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
trait BaseImplementation
{
    /**
     * @var string Account clearing number
     */
    protected $clearing = '0000';

    /**
     * @var string Check digit of the clearing number
     */
    protected $clearingCheckDigit = '';

    /**
     * @var string Account serial number
     */
    protected $serial = '000000';

    /**
     * @var string Check digit
     */
    protected $checkDigit = '0';

    /**
     * Get account as string
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->getClearing()
            . ','
            . $this->getSerialNumber()
            . $this->getCheckDigit();
    }

    /**
     * Get account as string
     *
     * @return string
     */
    public function __tostring()
    {
        return $this->getNumber();
    }

    /**
     * Get clearing number, 4 digits
     *
     * @return string
     */
    public function getClearing()
    {
        return $this->clearing;
    }

    /**
     * Get the check digit of the clearing number
     *
     * @return string Empty if not applicable
     */
    public function getClearingCheckDigit()
    {
        return $this->clearingCheckDigit;
    }

    /**
     * Get account serial number
     *
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serial;
    }

    /**
     * Get account check digit
     *
     * @return string
     */
    public function getCheckDigit()
    {
        return $this->checkDigit;
    }

    /**
     * Get account as a 16 digit number
     *
     * Clearing number (4 digits) + x number of ceros + account number
     *
     * @return string
     */
    public function to16()
    {
        return $this->getClearing()
            .str_pad($this->getSerialNumber(), 11, '0', STR_PAD_LEFT)
            .$this->getCheckDigit();
    }
}
