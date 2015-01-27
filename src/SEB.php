<?php

namespace byrokrat\banking;

/**
 * SEB account implementation
 */
class SEB implements AccountNumber
{
    use Component\Type1A;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_SEB;
    }

    protected function isValidClearing()
    {
        return (
            ( $this->getClearingNumber() >= 5000 && $this->getClearingNumber() <= 5999 )
            || ( $this->getClearingNumber() >= 9120 && $this->getClearingNumber() <= 9124 )
            || ( $this->getClearingNumber() >= 9130 && $this->getClearingNumber() <= 9149 )
        );
    }
}
