<?php

namespace byrokrat\banking;

/**
 * Account number implementation
 */
class AccountNumber implements AccountNumberInterface
{
    /**
     * @var string Name of bank
     */
    private $bankName;

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
     * @param string $bankName
     * @param string $clearing
     * @param string $clearingCheckDigit
     * @param string $serial
     * @param string $checkDigit
     */
    public function __construct($bankName, $clearing, $clearingCheckDigit, $serial, $checkDigit)
    {
        $this->bankName = $bankName;
        $this->clearing = $clearing;
        $this->clearingCheckDigit = $clearingCheckDigit;
        $this->serial = $serial;
        $this->checkDigit = $checkDigit;
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

    /**
     * Get name of Bank this number belongs to
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }
}
