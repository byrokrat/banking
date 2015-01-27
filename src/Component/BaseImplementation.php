<?php

namespace byrokrat\banking\Component;

/**
 * Base implementation of the AccountNumber interface
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
        return $this->getClearingNumber()
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
    public function getClearingNumber()
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
     * Clearing number (4 digits) + x number of ceros + serial number
     *
     * @return string
     */
    public function get16()
    {
        return $this->getClearingNumber()
            .str_pad($this->getSerialNumber(), 11, '0', STR_PAD_LEFT)
            .$this->getCheckDigit();
    }
}
