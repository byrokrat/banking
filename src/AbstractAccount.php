<?php

namespace byrokrat\banking;

/**
 * Account base implementation
 */
abstract class AbstractAccount implements AccountNumber
{
    /**
     * @var string The raw parsed number
     */
    private $raw;

    /**
     * @var string Account clearing number
     */
    private $clearing;

    /**
     * @var string Check digit of the clearing number
     */
    private $clearingCheckDigit;

    /**
     * @var string Account serial number
     */
    private $serial;

    /**
     * @var string Check digit
     */
    private $checkDigit;

    /**
     * Load account number data
     *
     * @param string $raw
     * @param string $clearing
     * @param string $clearingCheckDigit
     * @param string $serial
     * @param string $checkDigit
     */
    public function __construct($raw, $clearing, $clearingCheckDigit, $serial, $checkDigit)
    {
        $this->raw = $raw;
        $this->clearing = $clearing;
        $this->clearingCheckDigit = $clearingCheckDigit;
        $this->serial = $serial;
        $this->checkDigit = $checkDigit;
    }

    /**
     * Get the raw number
     *
     * @return string
     */
    public function getRawNumber()
    {
        return $this->raw;
    }

    /**
     * Get account as string
     *
     * @return string
     */
    public function getNumber()
    {
        return sprintf(
            '%s%s,%s-%s',
            $this->getClearingNumber(),
            $this->getClearingCheckDigit() ? '-' . $this->getClearingCheckDigit() : '',
            $this->getSerialNumber(),
            $this->getCheckDigit()
        );
    }

    /**
     * Get account as string
     *
     * @return string
     */
    public function __toString()
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
            . str_pad($this->getSerialNumber(), 11, '0', STR_PAD_LEFT)
            . $this->getCheckDigit();
    }
}
