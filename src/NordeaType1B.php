<?php

namespace byrokrat\banking;

/**
 * Nordea type 1B account
 */
class NordeaType1B implements AccountNumber
{
    use Component\Type1B;

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
        return $this->getClearingNumber() >= 4000 &&  $this->getClearingNumber() <= 4999;
    }
}
