<?php

namespace byrokrat\banking;

/**
 * Swedbank type 1 account
 */
class SwedbankType1 implements AccountNumber
{
    use Component\Type1A;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_SWEDBANK;
    }

    protected function isValidClearing()
    {
        return $this->getClearingNumber() >= 7000 && $this->getClearingNumber() <= 7999;
    }
}
