<?php

namespace byrokrat\banking;

use byrokrat\checkdigit\Modulo10;

/**
 * Swedbank type 2 account
 */
class SwedbankType2 implements AccountNumber
{
    use Component\Constructor;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_SWEDBANK;
    }

    protected function getStructure()
    {
        return "/^(\d{4}),?0{0,2}(\d{1,9})(\d)$/";
    }

    protected function isValidClearing()
    {
        return $this->getClearingNumber() >= 8000 && $this->getClearingNumber() <= 8999;
    }

    /**
     * @todo Should use validator instead
     */
    protected function isValidCheckDigit()
    {
        return (new Modulo10)->isValid(
            $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
