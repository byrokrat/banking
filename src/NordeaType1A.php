<?php

namespace byrokrat\banking;

/**
 * Nordea type 1A account
 */
class NordeaType1A implements AccountNumber
{
    use Component\Type1A;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_NORDEA;
    }

    /**
     * Validate clearing number (from Component\Constructor)
     *
     * @return boolean
     */
    protected function isValidClearing()
    {
        return (
            ($this->getClearingNumber() >= 1100 && $this->getClearingNumber() <= 1199)
            || ($this->getClearingNumber() >= 1400 && $this->getClearingNumber() <= 2099)
            || ($this->getClearingNumber() >= 3000 && $this->getClearingNumber() <= 3399 && $this->getClearingNumber() != 3300)
            || ($this->getClearingNumber() >= 3410 && $this->getClearingNumber() <= 3999 && $this->getClearingNumber() != 3782)
        );
    }
}
